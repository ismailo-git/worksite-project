<?php

namespace App\Entity;

use App\Repository\PointagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
* @UniqueEntity("chantier", message="Vous avez déja pointé ce chantier")
 * @ORM\Entity(repositoryClass=PointagesRepository::class)
 */
class Pointages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\GreaterThanOrEqual("today", message="Veuillez choisir une date valide")
     * @Assert\Date
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @Assert\Time
     * @Assert\LessThanOrEqual(propertyPath="endsAt", message="Le debut du pointage doit être inferieur ou egal à la fin du pointage")
     * @ORM\Column(type="time")
     */
    private $startsAt;

    /**
     * @Assert\Time
     * @Assert\GreaterThan(propertyPath="startsAt", message="La fin du pointage doit être superieur au debut du pointage")
     * @ORM\Column(type="time")
     */
    private $endsAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pointages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Chantier::class, inversedBy="pointages")
     * @ORM\JoinColumn(nullable=false, unique=true)
     */
    private $chantier;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStartsAt(): ?\DateTimeInterface
    {
        return $this->startsAt;
    }

    public function setStartsAt(\DateTimeInterface $startsAt): self
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    public function getEndsAt(): ?\DateTimeInterface
    {
        return $this->endsAt;
    }

    public function setEndsAt(\DateTimeInterface $endsAt): self
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getChantier(): ?Chantier
    {
        return $this->chantier;
    }

    public function setChantier(?Chantier $chantier): self
    {
        $this->chantier = $chantier;

        return $this;
    }

}
