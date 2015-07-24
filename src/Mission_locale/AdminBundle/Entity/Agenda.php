<?php

namespace Mission_locale\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agenda
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mission_locale\AdminBundle\Entity\AgendaRepository")
 */
class Agenda
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
     * @ORM\Column(name="iframe", type="text")
     */
    private $iframe;


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
     * Set iframe
     *
     * @param string $iframe
     *
     * @return Agenda
     */
    public function setIframe($iframe)
    {
        $this->iframe = $iframe;

        return $this;
    }

    /**
     * Get iframe
     *
     * @return string
     */
    public function getIframe()
    {
        return $this->iframe;
    }
}

