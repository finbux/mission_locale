<?php

namespace Mission_locale\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sous_item
 *
 * @ORM\Table("sous_item")
 * @ORM\Entity(repositoryClass="Mission_locale\MainBundle\Repository\Sous_itemRepository")
 */
class Sous_item
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
     * @ORM\ManyToOne(targetEntity="Category", cascade={"persist","remove"})
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
     * @ORM\Column(name="description", type="text")
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
     * @param \Mission_locale\MainBundle\Category $category
     *
     * @return Sous_item
     */
    public function setCategory(\Mission_locale\MainBundle\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Mission_locale\MainBundle\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
