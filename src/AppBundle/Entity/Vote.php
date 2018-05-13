<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="bi_vote")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_adress", type="string", length=128)
     */
    private $ipAdress;

    /**
    * @var Idea $idea
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Idea", inversedBy="votes", cascade={"remove"})
    * @ORM\JoinColumn(nullable=false)
    */
    public $idea;




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
     * Set ipAdress
     *
     * @param string $ipAdress
     *
     * @return Vote
     */
    public function setIpAdress($ipAdress)
    {
        $this->ipAdress = $ipAdress;

        return $this;
    }

    /**
     * Get ipAdress
     *
     * @return string
     */
    public function getIpAdress()
    {
        return $this->ipAdress;
    }

    /**
     * Set idea
     *
     * @param \AppBundle\Entity\Idea $idea
     *
     * @return Vote
     */
    public function setIdea(\AppBundle\Entity\Idea $idea)
    {
        $this->idea = $idea;

        return $this;
    }

    /**
     * Get idea
     *
     * @return \AppBundle\Entity\Idea
     */
    public function getIdea()
    {
        return $this->idea;
    }
}
