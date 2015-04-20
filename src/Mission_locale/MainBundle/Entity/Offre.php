<?php

namespace Mission_locale\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="nom_offre", type="string", length=100)
     */
    private $nomOffre;

    /**
     * @var string
     *
     * @ORM\Column(name="description_offre", type="text")
     */
    private $descriptionOffre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
}

