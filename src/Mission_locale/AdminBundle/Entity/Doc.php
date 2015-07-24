<?php

namespace Mission_locale\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doc
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mission_locale\AdminBundle\Entity\DocRepository")
 */
class Doc
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
     * @ORM\Column(name="nom_doc", type="string", length=255)
     */
    private $nomDoc;

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
     * Set nomDoc
     *
     * @param string $nomDoc
     *
     * @return Doc
     */
    public function setNomDoc($nomDoc)
    {
        $this->nomDoc = $nomDoc;

        return $this;
    }

    /**
     * Get nomDoc
     *
     * @return string
     */
    public function getNomDoc()
    {
        return $this->nomDoc;
    }

    /**
     * Set iframe
     *
     * @param string $iframe
     *
     * @return Doc
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

