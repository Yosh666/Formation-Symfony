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
     * @ORM\ManyToMany(targetEntity=Blocmodule::class, inversedBy="programmes")
     */
    private $blocmodules;

    /**
     * @ORM\ManyToMany(targetEntity=Session::class, inversedBy="programmes")
     */
    private $sessions;

    public function __construct()
    {
        $this->blocmodules = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

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

    /**
     * @return Collection|Blocmodule[]
     */
    public function getBlocmodules(): Collection
    {
        return $this->blocmodules;
    }

    //FIXME
    /*public function getBlocmodulesName(){
        return $this->getBlocmodules()->getName();
    }*/

    public function addBlocmodule(Blocmodule $blocmodule): self
    {
        if (!$this->blocmodules->contains($blocmodule)) {
            $this->blocmodules[] = $blocmodule;
        }

        return $this;
    }

    public function removeBlocmodule(Blocmodule $blocmodule): self
    {
        if ($this->blocmodules->contains($blocmodule)) {
            $this->blocmodules->removeElement($blocmodule);
        }

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
        }

        return $this;
    }
}
