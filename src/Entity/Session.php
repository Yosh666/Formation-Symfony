<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $started_at;

    /**
     * @ORM\Column(type="date")
     */
    private $ended_at;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nb_seat;

    /**
     * @ORM\ManyToMany(targetEntity=Stagiaire::class, mappedBy="sessions")
     */
    private $stagiaires;

    /**
     * @ORM\OneToMany(targetEntity=Programme::class, mappedBy="session",orphanRemoval=true)
     */
    private $programmes;

    public function __construct()
    {
        $this->stagiaires = new ArrayCollection();
        $this->programmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->started_at;
    }

    public function setStartedAt(\DateTimeInterface $started_at): self
    {
        $this->started_at = $started_at;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->ended_at;
    }

    public function setEndedAt(\DateTimeInterface $ended_at): self
    {
        $this->ended_at = $ended_at;

        return $this;
    }

    public function getNbSeat(): ?int
    {
        return $this->nb_seat;
    }

    public function setNbSeat(int $nb_seat): self
    {
        $this->nb_seat = $nb_seat;

        return $this;
    }

    /**
     * @return Collection|stagiaire[]
     */
    public function getStagiaires(): Collection
    {
        return $this->stagiaires;
    }

    public function getPlacesOccupees(){
        return count($this->getStagiaires());
    }

    public function addStagiaire(stagiaire $stagiaire): self
    {
        if (!$this->stagiaires->contains($stagiaire)) {
            $this->stagiaires[] = $stagiaire;
            $stagiaire->addSession($this);
        }

        return $this;
    }

    public function removeStagiaire(stagiaire $stagiaire): self
    {
        if ($this->stagiaires->contains($stagiaire)) {
            $this->stagiaires->removeElement($stagiaire);
            $stagiaire->removeSession($this);
        }

        return $this;
    }

    /**
     * @return Collection|Programme[]
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes[] = $programme;
            $programme->addSession($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->contains($programme)) {
            $this->programmes->removeElement($programme);
            $programme->removeSession($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getTitle();
    }
}
