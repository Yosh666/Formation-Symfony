<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Blocmodule;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categ1= new Categorie();
        $categ1  
            ->setName('Sidérurgie');
        $manager->persist($categ1);    
        $module1= new Blocmodule();
        $module1
            ->setName('Boulonnerie')
            ->setCategories($categ1);
        $manager->persist($module1);
        $module2= new Blocmodule();
        $module2
            ->setName('Soudure')
            ->setCategories($categ1);
        $manager->persist($module2);

        $categ2= new Categorie();
        $categ2
            ->setName('Peinture');
        $manager->persist($categ2);//ASK le nbre de persist
        $module3= new Blocmodule();
        $module3
            ->setName('Peinture sur soi')
            ->setCategories($categ2);
        $manager->persist($module3);
        $module4= new Blocmodule();
        $module4
            ->setName('Peinture sur d\'autres')
            ->setCategories($categ2);
        $manager->persist($module4);
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
