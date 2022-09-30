<?php

namespace App\Entity;

use App\Repository\CvJobExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvJobExperienceRepository::class)]
class CvJobExperience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $company = null;

    #[ORM\Column(length: 255)]
    private ?string $job_title = null;

    #[ORM\Column]
    private ?bool $work_load = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\ManyToOne(inversedBy: 'experiences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CvBaseInfo $cv = null;

    #[ORM\OneToMany(mappedBy: 'job', targetEntity: CvJobExperienceSkills::class, orphanRemoval: true)]
    private Collection $skills;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->job_title;
    }

    public function setJobTitle(string $job_title): self
    {
        $this->job_title = $job_title;

        return $this;
    }

    public function isWorkLoad(): ?bool
    {
        return $this->work_load;
    }

    public function setWorkLoad(bool $work_load): self
    {
        $this->work_load = $work_load;

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

    /**
     * @return Collection<int, CvJobExperienceSkills>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(CvJobExperienceSkills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
            $skill->setJob($this);
        }

        return $this;
    }

    public function removeSkill(CvJobExperienceSkills $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getJob() === $this) {
                $skill->setJob(null);
            }
        }

        return $this;
    }
}
