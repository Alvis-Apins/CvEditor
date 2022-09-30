<?php

namespace App\Entity;

use App\Repository\CvReferencesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvReferencesRepository::class)]
class CvReferences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $contact = null;

    #[ORM\ManyToOne(inversedBy: 'cv_references')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CvBaseInfo $cv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getCv(): ?CvBaseInfo
    {
        return $this->cv;
    }

    public function setCv(?CvBaseInfo $cv): self
    {
        $this->cv = $cv;

        return $this;
    }
}
