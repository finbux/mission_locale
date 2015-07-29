<?php

namespace Mission_locale\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Appel
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mission_locale\MainBundle\Repository\AppelRepository")
 */
class Appel
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
     * @ORM\Column(name="prenom", type="string", length=45,nullable=true)
     * @Assert\Regex("/\D/",message="Le prenom n'est pas valide")
     */
    private $prenom = null;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=14,)
     * @Assert\NotBlank(message="ce champ est obligatoire")
     * @Assert\Type(type="numeric",message="Le numéro doit comporter que des chiffres")
     * @Assert\Length(max=10,maxMessage="Le numéro doit faire au maximum {{ limit }} caractères")
     * @Assert\Length(min=10,minMessage="Le numéro doit faire au moins  {{ limit }} caractères")
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="avancement", type="string", length=100)
     */
    private $avancement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @var \Boolean
     *
     * @ORM\Column(name="entreprise",type="boolean")
     */
    private $entreprise;

    public function __construct()
    {
        $this->createdAt    = new \DateTime();
        $this->avancement = 'En attente';
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Appel
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Appel
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set avancement
     *
     * @param string $avancement
     *
     * @return Appel
     */
    public function setAvancement($avancement)
    {
        $this->avancement = $avancement;

        return $this;
    }

    /**
     * Get avancement
     *
     * @return string
     */
    public function getAvancement()
    {
        return $this->avancement;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Appel
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Appel
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }


    /**
     * Set entreprise
     *
     * @param boolean $entreprise
     *
     * @return Appel
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return boolean
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }
}
