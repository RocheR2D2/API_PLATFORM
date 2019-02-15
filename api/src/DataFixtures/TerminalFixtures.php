<?php
/**
 * Created by PhpStorm.
 * User: rocher
 * Date: 14/02/19
 * Time: 14:38
 */

namespace App\DataFixtures;

use App\Entity\Airport;
use App\Entity\Terminal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TerminalFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $airports = $manager->getRepository(Airport::class)->findAll();

        $alphabetArray = range('A','Z');

        foreach ($airports as $airport) {
            for($i=0; $i< mt_rand(0, 25); $i++){
                $terminal = new Terminal();
                $terminal->setName($alphabetArray[$i]);
                $terminal->setAirport($airport);

                $manager->persist($terminal);
            }
        }




        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
            AirportFixtures::class,
        ];
    }
}
