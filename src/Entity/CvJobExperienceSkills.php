<?php

namespace App\Entity;

use App\Repository\CvJobExperienceSkillsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvJobExperienceSkillsRepository::class)]
class CvJobExperienceSkills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $skill = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'skills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CvJobExperience $job = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkill(): ?string
    {
        return $this->skill;
    }

    public function setSkill(string $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getJob(): ?CvJobExperience
    {
        return $this->job;
    }

    public function setJob(?CvJobExperience $job): self
    {
        $this->job = $job;

        return $this;
    }
}
