<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Faker\Factory;
use App\Entity\Client;
use App\Entity\Invoice;
use App\Entity\InvoiceStatus;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $fake = Factory::create();
        $clients = $manager->getRepository(Client::class)->findAll();
        $status = $manager->getRepository(InvoiceStatus::class)->findAll();

        for($i = 0; $i < 500; $i++) {
            $invoice = new Invoice();
            $invoice->setClient($fake->randomElement($clients));
            $invoice->setReference($fake->unique()->numerify('INV-#####'));
            $invoice->setIssuedAt(DateTimeImmutable::createFromMutable($fake->dateTimeBetween('-1 year', 'now')));
            $invoice->setStatus($fake->randomElement($status));
            $manager->persist($invoice);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ClientFixtures::class,
            InvoiceStatusFixtures::class,
        ];
    }
}
