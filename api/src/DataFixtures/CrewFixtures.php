<?php
/**
 * Created by PhpStorm.
 * User: rocher
 * Date: 14/02/19
 * Time: 15:02
 */

namespace App\DataFixtures;


use App\Entity\Crew;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CrewFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $crew = new Crew();
            $crew->setFirstname($faker->firstName);
            $crew->setLastname($faker->lastName);
            $crew->setBirthday($faker->dateTimeThisCentury);
            $crew->setGender($faker->boolean);
            $manager->persist($crew);
        }
        $manager->flush();
    }
}
