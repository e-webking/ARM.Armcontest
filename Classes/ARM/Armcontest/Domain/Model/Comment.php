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
class Comment
{

    /**
     * @var \ARM\Armcontest\Domain\Model\Artwork
     * @ORM\ManyToOne(inversedBy="comments")
     */
    protected $artwork;

    /**
     * @var \ARM\Armcontest\Domain\Model\User
     * @ORM\ManyToOne(inversedBy="comments")
     */
    protected $user;

    /**
     * @Flow\Validate(type="StringLength", options={ "maximum"=500 })
     * @ORM\Column(type="text")
     * @var string
     */
    protected $comment;


    /**
     * @return \ARM\Armcontest\Domain\Model\Artwork
     */
    public function getArtwork()
    {
        return $this->artwork;
    }

    /**
     * @param \ARM\Armcontest\Domain\Model\Artwork $artwork
     * @return void
     */
    public function setArtwork(\ARM\Armcontest\Domain\Model\Artwork $artwork)
    {
        $this->artwork = $artwork;
    }

    /**
     * @return \ARM\Armcontest\Domain\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \ARM\Armcontest\Domain\Model\User $user
     * @return void
     */
    public function setUser(\ARM\Armcontest\Domain\Model\User $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return void
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

}
