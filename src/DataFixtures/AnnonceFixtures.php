<?php

namespace App\DataFixtures;
use App\Entity\Annonce;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AnnonceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

            $faker = Factory::create();
             $numberOfAuthors = 3;

            for ($i = 1; $i <= 20; $i++) {
                $annonce = new Annonce();
                $annonce->setTitre($faker->text(100))
                    ->setDescription($faker->text(mt_rand(150, 300)))
                    ->setPrix($faker->randomFloat(2, 0, 300))
                    ->setPhoto($faker->image('public/picture', 150, 150, 'transport', null, false))
                    ->setCreatedAt($faker->dateTimeThisDecade)
                    ->setCategory($this->getReference("category_". mt_rand(1, $numberOfAuthors)));

                $manager->persist($annonce);

                $manager->flush();
            }
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
