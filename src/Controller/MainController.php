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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends AbstractController
{
    /**
     * @Route("/weather", name="get_weather")
     */
    public function show_weather(Request $request) {
        $form = $this->createFormBuilder()
                ->add('city', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('submit', SubmitType::class, array('label' => 'Search', 'attr' => array('class' => "btn btn-lg btn-primary btn-block mt-2 d-flex justify-content-center")))
                ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $data = $form->getData();
            return $this->redirectToRoute('weather', array('city' => $data["city"]));
        }

        return $this->render('weather.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/weather/city={city}", name="weather")
     * @Method({"GET"})
     */
    public function weather($city, Request $request) {
        $form = $this->createFormBuilder()
                ->add('city', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('submit', SubmitType::class, array('label' => 'Search', 'attr' => array('class' => "btn btn-lg btn-primary btn-block mt-2 d-flex justify-content-center")))
                ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $data = $form->getData();
            return $this->redirectToRoute('weather', array('city' => $data["city"]));
        }

        return $this->render('weather1.html.twig', array('city' => $city, 'form' => $form->createView()));
    }
}
