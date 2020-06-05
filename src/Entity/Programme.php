<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Session;
use App\Entity\Blocmodule;

/**
 * @ORM\Entity(repositoryClass=ProgrammeRepository::class)
 */
class Programme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity=Blocmodule::class, inversedBy="programmes")
     */
    private $blocmodule;

    /**
     * @ORM\ManyToOne(targetEntity=Session::class, inversedBy="programmes")
     */
    private $session;

    /*public function __construct()
    {
        $this->blocmodules = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }*/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getBlocmodule(): ?Blocmodule
    {
        return $this->blocmodule;
    }

    public function setBlocmodule(?Blocmodule $blocmodule): self
    {
        $this->blocmodule = $blocmodule;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    
}
