<?php
// src/Sdz/UserBundle/DataFixtures/ORM/Users.php

namespace Sicc\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sicc\Bundle\UserBundle\Entity\Membre;

class Membres implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer
        $noms = array('winzou', 'John', 'Talus');

        foreach ($noms as $i => $nom) {
            // On crée l'utilisateur
            $users[$i] = new Membre;

            // Le nom d'utilisateur et le mot de passe sont identiques
            $users[$i]->setUsername($nom);
            $users[$i]->setPassword($nom);

            // Le sel et les rôles sont vides pour l'instant
            $users[$i]->setSalt('');
            $users[$i]->setRoles(array());

            // On le persiste
            $manager->persist($users[$i]);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }
}