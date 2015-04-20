<?php


namespace Mission_locale\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mission_locale\MainBundle\Entity\Sous_item;


class Sous_itemData implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $sous_item = new Sous_item();
        $sous_item->setNomSousItem('Préparer mon entretien');
        $sous_item->setDescription("<p>Je peux b&eacute;n&eacute;ficier d&#39;une aide pour r&eacute;diger mon cv, une lettre de motivation, me pr&eacute;parer &agrave; un entretien de recrutement.</p>
<ul>
	<li>Lors d&#39;un entretien avec un conseiller</li>
	<li>En participant &agrave; un atelier</li>
</ul>
");
        $manager->persist($sous_item);

        $sous_item2 = new Sous_item();
        $sous_item2->setNomSousItem('Découvrir l\'entreprise');
        $sous_item2->setDescription("<p>Une periode de mise en situation professionnelle en entreprise peut vous permettre de :</p>

<ul>
	<li>Confirmer le choix d&#39;un metier</li>
	<li>Evaluer vos comp&eacute;tences professionelles</li>
	<li>Faciliter l&#39;int&eacute;gration en entreprise</li>
</ul>
");
        $manager->persist($sous_item2);

        $sous_item3 = new Sous_item();
        $sous_item3->setNomSousItem('Faire le point sur ma situation');
        $sous_item3->setDescription('<p>En valorisant mes atouts personnels et <strong>professionnels</strong></p>');
        $manager->persist($sous_item3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}