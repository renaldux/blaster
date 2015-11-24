<?php

namespace Blaster\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="Blaster\TaskBundle\Entity\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=160)
     * @Assert\NotBlank()
     */
    private $name;


    // ...
    /**
     * @ORM\ManyToMany(targetEntity="Blaster\TaskBundle\Entity\Blaster", mappedBy="categories")
     */
    private $blasters;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blasters = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
     * Add blaster
     *
     * @param \Blaster\TaskBundle\Entity\Blaster $blaster
     *
     * @return Category
     */
    public function addBlaster(\Blaster\TaskBundle\Entity\Blaster $blaster)
    {
        $this->blasters[] = $blaster;

        return $this;
    }

    /**
     * Remove blaster
     *
     * @param \Blaster\TaskBundle\Entity\Blaster $blaster
     */
    public function removeBlaster(\Blaster\TaskBundle\Entity\Blaster $blaster)
    {
        $this->blasters->removeElement($blaster);
    }

    /**
     * Get blasters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlasters()
    {
        return $this->blasters;
    }
}
