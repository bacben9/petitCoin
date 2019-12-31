<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $category = $this->createCategory("Multimedia","1");
        $manager->persist($category);
        $category = $this->createCategory("Immobilier","2");
        $manager->persist($category);
        $category = $this->createCategory("Vehicule","3");
        $manager->persist($category);


        $manager->flush();
    }
    private function createCategory($category,$order){
        $cat = new Category();
        $cat ->setCategory($category);
        $this->addReference("category_$order", $cat);
        return $cat;
    }

}
