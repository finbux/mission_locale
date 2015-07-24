<?php

namespace Mission_locale\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Offre
 *
 * @ORM\Table("offre")
 * @ORM\Entity(repositoryClass="Mission_locale\MainBundle\Repository\OffreRepository")
 */
class Offre
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
     * @ORM\Column(name="num_offre", type="string",unique=true)
     * @Assert\Length(max=10,maxMessage="Le numéro doit faire au maximum {{ limit }} caractères")
     */
    private $numOffre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom_offre", type="string", length=100)
     */
    private $nomOffre;

    /**
     * @var string
     *
     * @ORM\Column(name="description_offre", type="text", nullable=true)
     */
    private $descriptionOffre;

    /**
     * @var string
     * @Gedmo\Slug(fields={"nomOffre"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt    = new \DateTime();
    }
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
     * Set nomOffre
     *
     * @param string $nomOffre
     *
     * @return Offre
     */
    public function setNomOffre($nomOffre)
    {
        $this->nomOffre = $nomOffre;

        return $this;
    }

    /**
     * Get nomOffre
     *
     * @return string
     */
    public function getNomOffre()
    {
        return $this->nomOffre;
    }

    /**
     * Set descriptionOffre
     *
     * @param string $descriptionOffre
     *
     * @return Offre
     */
    public function setDescriptionOffre($descriptionOffre)
    {
        $this->descriptionOffre = $descriptionOffre;

        return $this;
    }

    /**
     * Get descriptionOffre
     *
     * @return string
     */
    public function getDescriptionOffre()
    {
        return $this->descriptionOffre;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Offre
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Offre
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set numOffre
     *
     * @param string $numOffre
     *
     * @return Offre
     */
    public function setNumOffre($numOffre)
    {
        $this->numOffre = $numOffre;

        return $this;
    }

    /**
     * Get numOffre
     *
     * @return string
     */
    public function getNumOffre()
    {
        return $this->numOffre;
    }
}
