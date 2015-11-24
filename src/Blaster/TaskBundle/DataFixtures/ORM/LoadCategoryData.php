<?php

namespace Blaster\TaskBundle\DataFixtures\ORM;

use Blaster\TaskBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $cat1 = new Category();
        $cat1->setName('Naujienos');
        $manager->persist($cat1);
        $cat2 = new Category();
        $cat2->setName('Sportas');
        $manager->persist($cat2);
        $cat3 = new Category();
        $cat3->setName('Orai');
        $manager->persist($cat3);

        $manager->flush();

        $this->addReference('naujienos', $cat1);
        $this->addReference('sportas', $cat2);
        $this->addReference('orai', $cat3);
    }

    public function getOrder()
    {
        return 1;
    }
}