<?php
/**
 * Created by PhpStorm.
 * User: rocher
 * Date: 14/02/19
 * Time: 14:38
 */

namespace App\DataFixtures;

use App\Entity\Airport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AirportFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        // TODO: Implement load() method.
        $dat = fopen(dirname(__FILE__).'/Data/airport.dat', 'r');

        while ($line = fgets($dat))
        {
            $linearray = explode(",",$line);

            $airport = new Airport();
            $airport->setName(trim($linearray[1],"\""));
            $airport->setCity(trim($linearray[2],"\""));
            $airport->setCountry(trim($linearray[3],"\""));
            $manager->persist($airport);

        }


        fclose($dat);


        $manager->flush();

    }
}
