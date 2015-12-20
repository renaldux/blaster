<?php

namespace Blaster\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Blaster\TaskBundle\Validator\Constraints as  BlasterAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Blaster
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Blaster\TaskBundle\Entity\BlasterRepository")
 * @UniqueEntity("email")
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
     * @BlasterAssert\ContainsEmail
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
     * @Assert\NotBlank()
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Blaster\CrontaskBundle\Entity\Newsletter", mappedBy="user")
     */
    private $newsletters;

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

    /**
     * Add newsletter
     *
     * @param \Blaster\CrontaskBundle\Entity\Newsletter $newsletter
     *
     * @return Blaster
     */
    public function addNewsletter(\Blaster\CrontaskBundle\Entity\Newsletter $newsletter)
    {
        $this->newsletters[] = $newsletter;

        return $this;
    }

    /**
     * Remove newsletter
     *
     * @param \Blaster\CrontaskBundle\Entity\Newsletter $newsletter
     */
    public function removeNewsletter(\Blaster\CrontaskBundle\Entity\Newsletter $newsletter)
    {
        $this->newsletters->removeElement($newsletter);
    }

    /**
     * Get newsletters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsletters()
    {
        return $this->newsletters;
    }
}
