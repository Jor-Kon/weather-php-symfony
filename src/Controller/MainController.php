<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MainController extends AbstractController
{
    /**
     * @Route("/signup")
     * @Method({"GET", "POST"})
     */
    public function signup()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createFormBuilder($user)
                ->add('firstname', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('lastname', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('email', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control')))
                ->add('submit', SubmitType::class, array('label' => 'Signup'))
                ->getForm();
        
        return $this->render('signup.html.twig', array('form' => $form->createView()));


        // $firstname_err = "";
        // $lastname_err = "";
        // $email_err = "";
        // $password_err = "";

        // $input_firstname = trim($_POST["firstname"]);
        // if (empty($input_firstname)) {
        //     $firstname_err = "Please enter firstname.";
        // } else {
        //     $user->setfirstname($input_firstname);
        // }

        // $input_lastname = trim($_POST["lasttname"]);
        // if (empty($input_lastname)) {
        //     $lastname_err = "Please enter lastname.";
        // } else {
        //     $user->setlastname($input_lastname);
        // }

        // $input_email = trim($_POST["email"]);
        // if (empty($input_email)) {
        //     $email_err = "Please enter email.";
        // } else {
        //     $user->setemail($input_email);
        // }

        // $input_password = trim($_POST["password"]);
        // if (empty($input_password)) {
        //     $password_err = "Please enter password.";
        // } else {
        //     $user->setpassword(password_hash($input_password, PASSWORD_DEFAULT));
        // }
        // if (empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err)) {
        //     $entityManager->persist($user);
        //     $entityManager->flush();
        // }
    }

    // /**
    //  * @Route("/signin")
    //  */
    // public function login()
    // {
    //     $email = "";
    //     $password = "";

    //     $email_err = "";
    //     $password_err = "";

    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         $input_email = trim($_POST["email"]);
    //         if (empty($input_email)) {
    //             $email_err = "Please enter email.";
    //         } else {
    //             $email = $input_email;
    //         }
    //         $input_password = trim($_POST["password"]);
    //         if (empty($input_password)) {
    //             $password_err = "Please enter password.";
    //         } else {
    //             $password = $input_password;
    //         }

    //         if (empty($email_err) && empty($password_err)) {
    //             $sql = "SELECT password FROM users WHERE email = ?";

    //             if ($stmt = mysqli_prepare($link, $sql)) {
    //                 mysqli_stmt_bind_param($stmt, "s", $param_email);

    //                 $param_email = $email;

    //                 if (mysqli_stmt_execute($stmt)) {
    //                     $result = mysqli_stmt_get_result($stmt);

    //                     if (mysqli_num_rows($result) == 1) {

    //                         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //                         if (password_verify($password, $row["password"])) {

    //                             header("location: weather.php");
    //                             exit();
    //                         } else {
    //                             echo '<script>alert("Wrong password")</script>';
    //                         }
    //                     } else {
    //                         echo '<script>alert("Email does not exist in database")</script>';
    //                     }
    //                 } else {
    //                     echo '<script>alert("Error")</script>';
    //                 }
    //             }

    //             mysqli_stmt_close($stmt);
    //         }
    //         mysqli_close($link);
    //     }
    // }

    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function show_weather($weather) {
                
    }

    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        // return new Response('<html><body>Hello</body></html>');

        date_default_timezone_set('Poland');

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }
        $user_ip = "77.65.94.38";
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        $country = $geo["geoplugin_countryName"];
        $city = $geo["geoplugin_city"];

        $APIkey = "ef4848fce58d8fd9533c99b1280accee";
        $url = "api.openweathermap.org/data/2.5/weather?q=$city&lang=en&units=metric&&appid=$APIkey";
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($response, true);

        return $this->render('test.html.twig', array('json' => $json));
    }
}
