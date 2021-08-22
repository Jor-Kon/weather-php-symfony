<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
// class User
// {
//     /**
//      * @ORM\Id
//      * @ORM\GeneratedValue
//      * @ORM\Column(type="integer")
//      */
//     private $id;

//     /**
//      * @ORM\Column(type="text", length=100)
//      * @Assert\NotBlank()
//      */
//     public $firstname;

//     /**
//      * @ORM\Column(type="text", length=100)
//      * @Assert\NotBlank()
//      */
//     public $lastname;

//     /**
//      * @ORM\Column(type="text", length=255, unique=true)
//      * @Assert\NotBlank()
//      * @Assert\Email()
//      */
//     public $email;

//     /**
//      * @ORM\Column(type="text", length=255)
//      */
//     public $password;

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getfirstname() {
//         return $this->firstname;
//     }

//     public function setfirstname($firstname) {
//         $this->firstname = $firstname;
//     }

//     public function getlastname() {
//         return $this->lastname;
//     }

//     public function setlastname($lastname) {
//         $this->lastname = $lastname;
//     }

//     public function getemail() {
//         return $this->email;
//     }

//     public function setemail($email) {
//         $this->email = $email;
//     }

//     public function getpassword() {
//         return $this->password;
//     }

//     public function setpassword($password) {
//         $this->password = $password;
//     }

    
// }
