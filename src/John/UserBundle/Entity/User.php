<?php

namespace John\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
//    
//     /**
//     * @Mailer\Name()
//     *
//     * @return string
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @Mailer\Address()
//     *
//     * @return string
//     */
//    public function getEmail()
//    {
//        return $this->email;
//    }
}