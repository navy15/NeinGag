<?php

namespace AppBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

// class User implements UserInterface extends BaseUser{
//     /**
//      * @var int
//      */
//     private $id;

//     /**
//      * @var string
//      */
//     private $login;

//     /**
//      * @var string
//      */
//     private $plainPassword;

//     /**
//      * @var string
//      */
//     private $password;


//     /**
//      * Get id
//      *
//      * @return int
//      */
//     public function getId(){
//         return $this->id;
//     }

//     /**
//      * Set login
//      *
//      * @param string $login
//      *
//      * @return User
//      */
//     public function setLogin($login) {
//         $this->login = $login;

//         return $this;
//     }

//     /**
//      * Get login
//      *
//      * @return string
//      */
//     public function getLogin(){
//         return $this->login;
//     }

//     /**
//      * Set password
//      *
//      * @param string $password
//      *
//      * @return User
//      */
//     public function setPassword($password){
//         $this->password = $password;

//         return $this;
//     }

//     /**
//      * Get password
//      *
//      * @return string
//      */
//     public function getPassword(){
//         return $this->password;
//     }

//     /**
//      * Set password
//      *
//      * @param string $password
//      *
//      * @return User
//      */
//     public function setPlainPassword($plainPassword){
//         $this->plainPassword = $plainPassword;

//         return $this;
//     }

//     /**
//      * Get plainPassword
//      *
//      * @return string
//      */
//     public function getPlainPassword(){
//         return $this->plainPassword;
//     }

//     public function getSalt(){
//         // The bcrypt algorithm doesn't require a separate salt.
//         return null;
//     }

//     public function getRoles(){

//     }

//     /**
//      * Removes sensitive data from the user.
//      *
//      * This is important if, at any given point, sensitive information like
//      * the plain-text password is stored on this object.
//      */
//     public function eraseCredentials(){

//     }
//     /**
//      * Returns the username used to authenticate the user.
//      *
//      * @return string The username
//      */
//     public function getUsername(){

//     }
//}

class User extends BaseUser
{
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @var string
     */
    private $oneToMany;


    /**
     * Set oneToMany
     *
     * @param string $oneToMany
     *
     * @return User
     */
    public function setOneToMany($oneToMany)
    {
        $this->oneToMany = $oneToMany;

        return $this;
    }

    /**
     * Get oneToMany
     *
     * @return string
     */
    public function getOneToMany()
    {
        return $this->oneToMany;
    }
}
