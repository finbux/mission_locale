<?php

namespace Mission_locale\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * SousItem
 *
 * @ORM\Table("sous_item")
 * @ORM\Entity(repositoryClass="Mission_locale\MainBundle\Repository\SousItemRepository")
 */
class SousItem
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
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_sous_item", type="string", length=255)
     */
    private $nomSousItem;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"nomSousItem"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message="ce champ est obligatoire")
     */
    private $description;


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
     * Set nomSousItem
     *
     * @param string $nomSousItem
     *
     * @return Sous_item
     */
    public function setNomSousItem($nomSousItem)
    {
        $this->nomSousItem = $nomSousItem;

        return $this;
    }

    /**
     * Get nomSousItem
     *
     * @return string
     */
    public function getNomSousItem()
    {
        return $this->nomSousItem;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Sous_item
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param \Mission_locale\MainBundle\Entity\SousItem $category
     *
     * @return Sousitem
     */
    public function setCategory(\Mission_locale\MainBundle\Entity\Item $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Mission_locale\MainBundle\\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return SousItem
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
}
