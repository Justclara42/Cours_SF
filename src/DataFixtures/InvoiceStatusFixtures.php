<?php

namespace App\DataFixtures;

use App\Entity\InvoiceStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InvoiceStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $statusData = [
            ['id' => 1, 'name' => 'draft'],
            ['id' => 2, 'name' => 'sent'],
            ['id' => 3, 'name' => 'paid'],
            ['id' => 4, 'name' => 'awaiting'],
            ['id' => 5, 'name' => 'rejected'],
            ['id' => 6, 'name' => 'relinquished']
        ];

        foreach ($statusData as $data) {
            $status = new InvoiceStatus();
            $status->setName($data['name']);
            $manager->persist($status);
        }

        $manager->flush();
    }

}
