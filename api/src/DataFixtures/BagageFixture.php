<?php
/**
 * Created by PhpStorm.
 * User: rocher
 * Date: 14/02/19
 * Time: 15:22
 */

namespace App\DataFixtures;


use App\Entity\Bagage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BagageFixture extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($cpt = 0; $cpt < 20; $cpt++)
        {
            $bagage = new Bagage();
            $bagage->setName($faker->name);
            $bagage->setWeight($faker->numberBetween(5, 34));
            $manager->persist($bagage);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ReservationFixture::class,
        ];
    }
}
