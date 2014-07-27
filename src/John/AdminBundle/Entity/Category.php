<?php

namespace John\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="John\AdminBundle\Repository\CategoryRepository")
 */
class Category {

    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    
    /**
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_visible", type="boolean", nullable=true)
     */
    private $isVisible;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="chapo", type="text", nullable=true)
     */
    private $chapo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;
    
    /**
     * @Assert\File(maxSize="2M")
     */
    public $file;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_picture", type="boolean", nullable=true)
     */
    private $isPicture;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, nullable=true)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=255, nullable=true)
     */
    private $metaDescription;

    /**
     * @ORM\OneToMany(targetEntity="John\AdminBundle\Entity\Article", mappedBy="category") 
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="John\AdminBundle\Entity\SubCategory", mappedBy="category") 
     */
    private $subCategories;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="contact_cat", type="boolean", nullable=true)
     */
    private $contactCat;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Category
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Category
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     * @return Category
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get isVisible
     *
     * @return boolean 
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Category
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Category
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
     * Set chapo
     *
     * @param string $chapo
     * @return Category
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;

        return $this;
    }

    /**
     * Get chapo
     *
     * @return string 
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Category
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set isPicture
     *
     * @param boolean $isPicture
     * @return Category
     */
    public function setIsPicture($isPicture)
    {
        $this->isPicture = $isPicture;

        return $this;
    }

    /**
     * Get isPicture
     *
     * @return boolean 
     */
    public function getIsPicture()
    {
        return $this->isPicture;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Category
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Category
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Category
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set contactCat
     *
     * @param boolean $contactCat
     * @return Category
     */
    public function setContactCat($contactCat)
    {
        $this->contactCat = $contactCat;

        return $this;
    }

    /**
     * Get contactCat
     *
     * @return boolean 
     */
    public function getContactCat()
    {
        return $this->contactCat;
    }

    /**
     * Add articles
     *
     * @param \John\AdminBundle\Entity\Article $articles
     * @return Category
     */
    public function addArticle(\John\AdminBundle\Entity\Article $article)
    {
        $this->articles[] = $article;
        $article->setCategory($this);
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \John\AdminBundle\Entity\Article $articles
     */
    public function removeArticle(\John\AdminBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add subCategories
     *
     * @param \John\AdminBundle\Entity\SubCategory $subCategories
     * @return Category
     */
    public function addSubCategory(\John\AdminBundle\Entity\SubCategory $subCategorie)
    {
        $this->subCategories[] = $subCategorie;
        $subCategorie->setCategory($this);
        return $this;
    }

    /**
     * Remove subCategories
     *
     * @param \John\AdminBundle\Entity\SubCategory $subCategories
     */
    public function removeSubCategory(\John\AdminBundle\Entity\SubCategory $subCategories)
    {
        $this->subCategories->removeElement($subCategories);
    }

    /**
     * Get subCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubCategories()
    {
        return $this->subCategories;
    }

    /**
     * Add subCategories
     *
     * @param \John\AdminBundle\Entity\SubCategory $subCategories
     * @return Category
     */
    public function addSubCategorie(\John\AdminBundle\Entity\SubCategory $subCategorie)
    {
        $this->subCategories[] = $subCategorie;
        $subCategorie->setCategory($this);
        return $this;
    }

    /**
     * Remove subCategories
     *
     * @param \John\AdminBundle\Entity\SubCategory $subCategories
     */
    public function removeSubCategorie(\John\AdminBundle\Entity\SubCategory $subCategories)
    {
        $this->subCategories->removeElement($subCategories);
    }
    
    public function getWebPath()
    {
        return null === $this->picture ? null : $this->getUploadDir() . '/' . $this->picture;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads';
    }

    public function uploadProfilePicture()
    {
        $fileNameExplode = explode('.', $this->file->getClientOriginalName());
        $filenameExtension = end($fileNameExplode);
        $fileName = md5(sha1($this->file->getClientOriginalName().microtime(true))).'.'.$filenameExtension;
        
        // Nous utilisons le nom de fichier original, donc il est dans la pratique
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité
        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $fileName);

        // On sauvegarde le nom de fichier
        $this->picture = $fileName;

        // La propriété file ne servira plus
        $this->file = null;
    }
}
