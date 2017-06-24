<?php

namespace AppBundle\Entity;

/**
 * Vote
 */
class Vote
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var vote
     */
    private $vote;

    /**
     * @var \stdClass
     */
    private $user;

    /**
     * @var \stdClass
     */
    private $post;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set vote
     *
     * @param boolean $votePlus
     *
     * @return Vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return boolean
     */
    public function getVote()
    {
        return $this->vote;
    }


    /**
     * Set user
     *
     * @param \stdClass $user
     *
     * @return Vote
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \stdClass
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set post
     *
     * @param \stdClass $post
     *
     * @return Vote
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \stdClass
     */
    public function getPost()
    {
        return $this->post;
    }
}
