<?php
/**
 * Created by PhpStorm.
 * User: rocher
 * Date: 14/02/19
 * Time: 14:38
 */

namespace App\DataFixtures;

use App\Entity\Gate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class GateFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.

        for($i=0; $i<4; $i++) {
            $gate = new Gate();
            $gate->setName($i);
            $manager->persist($gate);
        }

        $manager->flush();
    }

    public function getDependencies(){
        return array(
            TerminalFixtures::class
        );
    }
}
