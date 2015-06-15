<?php

namespace Mission_locale\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Antenne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mission_locale\AdminBundle\Entity\AntenneRepository")
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
     * @Assert\NotBlank(message="ce champ est obligatoire")
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="horaire", type="text", nullable=true)
     */

    private $horaire;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5)
     * @Assert\Type(type="numeric",message="le code postal doit se composer de chiffres")
     * @Assert\Length(max=5,maxMessage="Le code postal doit faire au maximum {{ limit }} caractères")
     * @Assert\Length(min=5,minMessage="Le code postal doit faire au minimum {{ limit }} caractères")
     */

    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string",nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="path_img", type="text",nullable=true)
     */
    private $path_img;

    /**
     * @var float
     * @Assert\NotBlank(message="ce champ est obligatoire")
     * @ORM\Column(name="lat", type="text")
     */
    private $lat;

    /**
     * @var float
     * @Assert\NotBlank(message="ce champ est obligatoire")
     * @ORM\Column(name="lng", type="text")
     */
    private $lng;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return Antenne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
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
     * Set horaire
     *
     * @param string $horaire
     *
     * @return Antenne
     */
    public function setHoraire($horaire)
    {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * Get horaire
     *
     * @return string
     */
    public function getHoraire()
    {
        return $this->horaire;
    }

    /**
     * Set pathImg
     *
     * @param string $pathImg
     *
     * @return Antenne
     */
    public function setPathImg($pathImg)
    {
        $this->path_img = $pathImg;

        return $this;
    }

    /**
     * Get pathImg
     *
     * @return string
     */
    public function getPathImg()
    {
        return $this->path_img;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Antenne
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param integer $ville
     *
     * @return Antenne
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return integer
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Antenne
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return Antenne
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }
}
