<?php

namespace App\DataFixtures;

use App\Entity\Plane;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $dat = fopen(dirname(__FILE__).'/Data/airplane.dat', 'r');

        while ($line = fgets($dat))
        {
            $linearray = explode(",",$line);
            $plane = new Plane();
            $manufacture = explode(" ",$linearray[0])[0];
            $plane->setName(trim($linearray[0],"\""));
            $plane->setManufacture(trim($manufacture,"\""));
            $plane->setPlace($linearray[3]);
            $manager->persist($plane);
        }


        fclose($dat);


        $manager->flush();

    }
}
