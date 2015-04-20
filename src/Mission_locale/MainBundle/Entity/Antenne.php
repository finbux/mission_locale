<?php

namespace Mission_locale\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Antenne
 *
 * @ORM\Table("antenne")
 * @ORM\Entity(repositoryClass="Mission_locale\MainBundle\Repository\AntenneRepository")
 */
class Antenne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_antenne", type="string", length=45)
     */
    private $nomAntenne;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Antenne
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set nomAntenne
     *
     * @param string $nomAntenne
     *
     * @return Antenne
     */
    public function setNomAntenne($nomAntenne)
    {
        $this->nomAntenne = $nomAntenne;

        return $this;
    }

    /**
     * Get nomAntenne
     *
     * @return string
     */
    public function getNomAntenne()
    {
        return $this->nomAntenne;
    }
}

