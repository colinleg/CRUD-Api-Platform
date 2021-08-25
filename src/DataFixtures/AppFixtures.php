<?php

namespace App\DataFixtures;

use DateTimeInterface;
use App\Entity\Stagiaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
        

        for( $i = 0; $i < 20 ; $i++){

            $stagiaire = new Stagiaire;

            $stagiaire->setNom('nom' . $i);
            $stagiaire->setPrenom('prenom' . $i);
            $stagiaire->setTelephone('01'. $i . '6457894');
            $stagiaire->setAdresse($i . 'rue des stagiaires');
            $stagiaire->setDiplôme(false);
            $stagiaire->setDateNaissance(new \DateTime('06/'. $i .'/2000'));
            $stagiaire->setContrat(true);
            $stagiaire->setPhoto('images/image' . $i . '.jpg');
            $stagiaire->setDescription('Un stagiaire un peu comme les autres');

            $manager->persist($stagiaire);

            $manager->flush();
        
        }



        // $manager->persist($stagiaire);

        // $manager->flush();
    }
}
