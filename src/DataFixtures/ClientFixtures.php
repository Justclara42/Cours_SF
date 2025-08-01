<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i =0; $i < 100; $i++) {
            $client = new Client();
            $client->setCompanyName($faker->company())
                    ->setContactName($faker->name())
                    ->setEmail($faker->email())
                    ->setPhone($faker->phoneNumber());
            $manager->persist($client);
        }
        $manager->flush();
    }
}
