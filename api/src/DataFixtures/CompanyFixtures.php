<?php
/**
 * Created by PhpStorm.
 * User: rocher
 * Date: 14/02/19
 * Time: 15:22
 */

namespace App\DataFixtures;


use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CompanyFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $dat = fopen(dirname(__FILE__).'/Data/airline_company.dat', 'r');
        $faker = Faker\Factory::create('fr_FR');

        while ($line = fgets($dat))
        {
            $linearray = explode(",",$line);

            $company = new Company();
            $company->setName(trim($linearray[1],"\""));
            $company->setEmail($faker->email);
            $company->setPhonenumber($faker->phoneNumber);
            $manager->persist($company);

        }


        fclose($dat);

        $manager->flush();
    }
}
