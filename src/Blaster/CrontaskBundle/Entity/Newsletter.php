<?php

namespace Blaster\CrontaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CronTask
 *
 * @ORM\Entity
 * @ORM\Table(name="newsletter")
 */
class Newsletter
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
     * @ORM\ManyToOne(targetEntity="Blaster\TaskBundle\Entity\Blaster", inversedBy="newsletters")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastrun", type="datetime", nullable=true)
     */
    private $lastrun;

    /**
     * @ORM\ManyToOne(targetEntity="Blaster\TaskBundle\Entity\Category", inversedBy="newsletter")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

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
     * Set lastrun
     *
     * @param \DateTime $lastrun
     *
     * @return Newsletter
     */
    public function setLastrun($lastrun)
    {
        $this->lastrun = $lastrun;

        return $this;
    }

    /**
     * Get lastrun
     *
     * @return \DateTime
     */
    public function getLastrun()
    {
        return $this->lastrun;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getUser()->getName();
    }

    /**
     * Set user
     *
     * @param \Blaster\TaskBundle\Entity\Blaster $user
     *
     * @return Newsletter
     */
    public function setUser(\Blaster\TaskBundle\Entity\Blaster $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Blaster\TaskBundle\Entity\Blaster
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param \Blaster\TaskBundle\Entity\Category $category
     *
     * @return Newsletter
     */
    public function setCategory(\Blaster\TaskBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Blaster\TaskBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
