<?php

namespace App\Entity;

use App\Repository\CvWebLinksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvWebLinksRepository::class)]
class CvWebLinks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'urls')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CvBaseInfo $cv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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
