<?php
namespace ARM\Armcontest\Domain\Model;

/*
 * This file is part of the ARM.Armcontest package.
 */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Artwork
{

    /**
     * @ORM\ManyToOne(inversedBy="artworks")
     * @var \ARM\Armcontest\Domain\Model\Contest
     */
    protected $contest;

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
     * @ORM\OneToOne(cascade={"persist"})
	 * @var \TYPO3\Media\Domain\Model\Image
     */
    protected $file;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection<\ARM\Armcontest\Domain\Model\Comment>
     * @ORM\OneToMany(mappedBy="user")
     */
    protected $comments;
    
    /**
     * 
     * @var integer
     */
    protected $vote;
    
    /**
     * @var boolean
     */
    protected $approved;
    


    /**
     * @return \ARM\Armcontest\Domain\Model\Contest
     */
    public function getContest()
    {
        return $this->contest;
    }

    /**
     * @param \ARM\Armcontest\Domain\Model\Contest $contest
     * @return void
     */
    public function setContest(\ARM\Armcontest\Domain\Model\Contest $contest)
    {
        $this->contest = $contest;
    }

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
     * @return \TYPO3\Media\Domain\Model\Image
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param \TYPO3\Media\Domain\Model\Image $file
     * @return void
     */
    public function setFile(\TYPO3\Media\Domain\Model\Image $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }
  
    /**
     * @param Comment $comment
     * @return void
     */
    public function addComment(Comment $comment)
    {
    	$this->comments->add($comment);
    }
    
    /**
     * @param Comment $comment
     * @return void
     */
    public function removeComment(Comment $comment)
    {
    	$this->comments->removeElement($comment);
    }
    
    /**
     * @return integer
     */
    public function getVote()
    {
    	return $this->vote;
    }
    
    /**
     * @param integer $vote
     * @return void
     */
    public function setVote($vote)
    {
    	$this->vote = $vote;
    }

    /**
     * @return boolean
     */
    public function getApproved()
    {
    	return $this->approved;
    }
    
    /**
     * @param boolean $approved
     * @return void
     */
    public function setApproved($approved)
    {
    	$this->approved = $approved;
    }
}
