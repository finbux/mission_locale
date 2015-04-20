<?php

namespace Mission_locale\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mission_locale\MainBundle\Entity\Category;

class CategoryData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $categorie = new Category();
        $categorie->setNameCategory('Je cherche une idée');
        $categorie->setSlug('emploi');
        $categorie->setClass('block_emploi');
        $manager->persist($categorie);

        $categorie2 = new Category();
        $categorie2->setNameCategory('Je veux me former');
        $categorie2->setSlug('etre-former');
        $categorie2->setClass('block_former');
        $manager->persist($categorie2);

        $categorie3 = new Category();
        $categorie3->setNameCategory('Je ne sais pas quoi faire');
        $categorie3->setSlug('quoi-faire');
        $categorie3->setClass('block_faire');
        $manager->persist($categorie3);

        $categorie4 = new Category();
        $categorie4->setNameCategory('Je recherche des infos pratiques');
        $categorie4->setSlug('quotidien');
        $categorie4->setClass('block_quotidien');
        $manager->persist($categorie4);

        $manager->flush();

        $this->addReference('categorie1',$categorie);
        $this->addReference('categorie2',$categorie2);
        $this->addReference('categorie3',$categorie3);
        $this->addReference('categorie4',$categorie4);
    }

    public function getOrder()
    {
        return 1;
    }

}