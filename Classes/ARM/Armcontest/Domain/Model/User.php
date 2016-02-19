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
class User extends \TYPO3\Party\Domain\Model\Person
{

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection<\ARM\Armcontest\Domain\Model\Artwork>
     * @ORM\OneToMany(mappedBy="user")
     */
    protected $artworks;

    /**
     * @var string
     */
    protected $stripeAccount;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection<\ARM\Armcontest\Domain\Model\Comment>
     * @ORM\OneToMany(mappedBy="user")
     */
    protected $comments;


    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtworks()
    {
        return $this->artworks;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $artworks
     * @return void
     */
    public function setArtworks(\Doctrine\Common\Collections\Collection $artworks)
    {
        $this->artworks = $artworks;
    }

    /**
     * @return string
     */
    public function getStripeAccount()
    {
        return $this->stripeAccount;
    }

    /**
     * @param string $stripeAccount
     * @return void
     */
    public function setStripeAccount($stripeAccount)
    {
        $this->stripeAccount = $stripeAccount;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
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

}
