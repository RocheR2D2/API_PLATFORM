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

class GateFixtures extends Fixture
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
}
