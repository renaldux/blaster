<?php

namespace Blaster\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Events;

/**
 * Blaster
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Blaster\TaskBundle\Entity\BlasterRepository")
 */
class Blaster
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
     * @ORM\Column(name="email", type="string", length=64)
     * @Assert\NotBlank()
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.", checkMX = true, checkHost = true)
     */
    
    private $email;

    /**
     * @ORM\Column(name="name", type="string", length=64)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Blaster\TaskBundle\Entity\Category", inversedBy="blasters")
     * @ORM\JoinTable(name="users2categories")
     */
    private $categories;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set email
     *
     * @param string $email
     *
     * @return Blaster
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
     * Add category
     *
     * @param \Blaster\TaskBundle\Entity\Category $category
     *
     * @return Blaster
     */
    public function addCategory(\Blaster\TaskBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Blaster\TaskBundle\Entity\Category $category
     */
    public function removeCategory(\Blaster\TaskBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Blaster
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
