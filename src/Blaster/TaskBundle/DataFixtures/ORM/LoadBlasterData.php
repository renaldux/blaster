<?php

namespace Blaster\TaskBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blaster\TaskBundle\Entity\Blaster;

/**
 * Class LoadBlasterData
 * @package Blaster\TaskBundle\DataFixtures\ORM
 */
class LoadBlasterData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $john = new Blaster();
        $john->setName('John Smith');
        $john->setEmail('johns@email.com');
        $john->addCategory($this->getReference('orai'));
        $manager->persist($john);

        $marry = new Blaster();
        $marry->setName('Marry Brown');
        $marry->setEmail('marry@brown.com');
        $marry->addCategory($this->getReference('sportas'));
        $marry->addCategory($this->getReference('naujienos'));
        $manager->persist($marry);

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}