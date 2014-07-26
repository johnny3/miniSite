<?php

namespace John\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="info")
 * @ORM\Entity(repositoryClass="John\AdminBundle\Repository\InfoRepository")
 */
class Info
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sentence_footer", type="string", length=255, nullable=true)
     */
    private $sentenceFooter;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set title
     *
     * @param string $title
     * @return Info
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Info
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set sentenceFooter
     *
     * @param string $sentenceFooter
     * @return Info
     */
    public function setSentenceFooter($sentenceFooter)
    {
        $this->sentenceFooter = $sentenceFooter;

        return $this;
    }

    /**
     * Get sentenceFooter
     *
     * @return string 
     */
    public function getSentenceFooter()
    {
        return $this->sentenceFooter;
    }
}