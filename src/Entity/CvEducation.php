<?php

namespace App\Entity;

use App\Repository\CvEducationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvEducationRepository::class)]
class CvEducation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $institution = null;

    #[ORM\Column(length: 255)]
    private ?string $faculty = null;

    #[ORM\Column(length: 255)]
    private ?string $study_field = null;

    #[ORM\Column(length: 255)]
    private ?string $education_level = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\ManyToOne(inversedBy: 'educations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CvBaseInfo $cv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    public function setInstitution(string $institution): self
    {
        $this->institution = $institution;

        return $this;
    }

    public function getFaculty(): ?string
    {
        return $this->faculty;
    }

    public function setFaculty(string $faculty): self
    {
        $this->faculty = $faculty;

        return $this;
    }

    public function getStudyField(): ?string
    {
        return $this->study_field;
    }

    public function setStudyField(string $study_field): self
    {
        $this->study_field = $study_field;

        return $this;
    }

    public function getEducationLevel(): ?string
    {
        return $this->education_level;
    }

    public function setEducationLevel(string $education_level): self
    {
        $this->education_level = $education_level;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

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
