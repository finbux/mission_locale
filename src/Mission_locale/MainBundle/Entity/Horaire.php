<?php

namespace Mission_locale\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horaire
 *
 * @ORM\Table("horaire")
 * @ORM\Entity(repositoryClass="Mission_locale\MainBundle\Repository\HoraireRepository")
 */
class Horaire
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
     * @ORM\ManyToOne(targetEntity="Mission_locale\MainBundle\Antenne", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $antenne;

    /**
     * @var string
     *
     * @ORM\Column(name="jour", type="string", length=45)
     */
    private $jour;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_ouverture", type="string", length=5)
     */
    private $heureOuverture;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_fermeture", type="string", length=5)
     */
    private $heureFermeture;


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
     * Set jour
     *
     * @param string $jour
     *
     * @return Horaire
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set heureOuverture
     *
     * @param string $heureOuverture
     *
     * @return Horaire
     */
    public function setHeureOuverture($heureOuverture)
    {
        $this->heureOuverture = $heureOuverture;

        return $this;
    }

    /**
     * Get heureOuverture
     *
     * @return string
     */
    public function getHeureOuverture()
    {
        return $this->heureOuverture;
    }

    /**
     * Set heureFermeture
     *
     * @param string $heureFermeture
     *
     * @return Horaire
     */
    public function setHeureFermeture($heureFermeture)
    {
        $this->heureFermeture = $heureFermeture;

        return $this;
    }

    /**
     * Get heureFermeture
     *
     * @return string
     */
    public function getHeureFermeture()
    {
        return $this->heureFermeture;
    }

    /**
     * Set antenne
     *
     * @param \Mission_locale\MainBundle\Antenne $antenne
     *
     * @return Horaire
     */
    public function setAntenne(\Mission_locale\MainBundle\Antenne $antenne)
    {
        $this->antenne = $antenne;

        return $this;
    }

    /**
     * Get antenne
     *
     * @return \Mission_locale\MainBundle\Antenne
     */
    public function getAntenne()
    {
        return $this->antenne;
    }
}
