<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("US-en");
        for ($i=0; $i < 20 ; $i++) { 
            $ad = new Ad();

            $title = $faker->sentence();
            $coverImage = $faker->imageUrl(1000, 300);
            $introduction = $faker->paragraph(2);
            $content = '<p></p>' . join('<p></p>',$faker->paragraphs(5)) . '</p>';

            $ad->setTitle($title)
            ->setSlug(str_replace(' ', '-', strtolower($title)))
            ->setConverImage($coverImage)
            ->setIntroduction($introduction)
            ->setContent($content)
            ->setPrice(mt_rand(10,120))
            ->setRooms(mt_rand(1,7));

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
