<?php
namespace ARM\Armcontest\Domain\Model;

/*
 * This file is part of the ARM.Armcontest package.
 */
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Contest
{

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=5, "maximum"=150 })
     * @ORM\Column(length=150)
     * @var string
     */
    protected $name;

    /**
     * @Flow\Validate(type="StringLength", options={ "maximum"=500 })
     * @ORM\Column(type="text")
     * @var string
     */
    protected $description;

    /**
     * @ORM\OneToMany(mappedBy="contest")
     * @var \Doctrine\Common\Collections\ArrayCollection<\ARM\Armcontest\Domain\Model\Artwork>
     */
    protected $artworks;

    /**
     * @var boolean
     */
    protected $voting;
    
    /**
     * @var boolean
     */
    protected $submission;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection<\ARM\Armcontest\Domain\Model\Artwork>
     */
    public function getArtworks()
    {
        return $this->artworks;
    }

    /**
     * @param \ARM\Armcontest\Domain\Model\Artwork $artwork
     * @return void
     */
    public function addArtwork(\ARM\Armcontest\Domain\Model\Artwork $artwork)
    {
        $this->artworks->add($artwork);
    }

    /**
     * @param \ARM\Armcontest\Domain\Model\Artwork $artwork
     * @return void
     */
    public function removeArtwork(\ARM\Armcontest\Domain\Model\Artwork $artwork)
    {
    	$this->artworks->removeElement($artwork);
    }
    
    /**
     * @return boolean
     */
    public function getVoting()
    {
        return $this->voting;
    }

    /**
     * @param boolean $voting
     * @return void
     */
    public function setVoting($voting)
    {
        $this->voting = $voting;
    }
    
    /**
     * @return boolean
     */
    public function getSubmission()
    {
    	return $this->submission;
    }
    
    /**
     * @param boolean $submission
     * @return void
     */
    public function setSubmission($submission)
    {
    	$this->submission = $submission;
    }

}
