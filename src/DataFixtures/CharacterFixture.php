<?php

namespace App\DataFixtures;

use App\Entity\Character;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CharacterFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $character = new Character();
        $character->setName('Elidoril Stormael');
        $character->setNameDay('1st Sun of the 1st Astral Moon');
        $character->setBio('lorem ipsum');
        $character->setServer('Twintania');
        $character->setDataCenter('Light');
        $character->setPortrait('https://img2.finalfantasyxiv.com/f/83972720add129ce119114029f970e48_c33f640c0cdd35f7def85b8aa31a0007fl0_640x873.jpg?1652203818');
        $character->setAvatar('https://img2.finalfantasyxiv.com/f/83972720add129ce119114029f970e48_c33f640c0cdd35f7def85b8aa31a0007fc0_96x96.jpg?1652203818');

        // Let's persist this entity in the database
        $manager->persist($character);

        $manager->flush();
    }
}
