<?php

namespace App\Entity;

use App\Repository\CvBaseInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvBaseInfoRepository::class)]
class CvBaseInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $about = null;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: CvAddress::class, orphanRemoval: true)]
    private Collection $addresses;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: CvLanguages::class, orphanRemoval: true)]
    private Collection $languages;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: CvReferences::class, orphanRemoval: true)]
    private Collection $cv_references;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: CvWebLinks::class, orphanRemoval: true)]
    private Collection $urls;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: CvEducation::class, orphanRemoval: true)]
    private Collection $educations;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: CvJobExperience::class, orphanRemoval: true)]
    private Collection $experiences;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: CvPicture::class, orphanRemoval: true)]
    private Collection $pictures;


    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->cv_references = new ArrayCollection();
        $this->urls = new ArrayCollection();
        $this->educations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(string $about): self
    {
        $this->about = $about;

        return $this;
    }

    /**
     * @return Collection<int, CvAddress>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(CvAddress $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
            $address->setCv($this);
        }

        return $this;
    }

    public function removeAddress(CvAddress $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCv() === $this) {
                $address->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CvLanguages>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(CvLanguages $language): self
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
            $language->setCv($this);
        }

        return $this;
    }

    public function removeLanguage(CvLanguages $language): self
    {
        if ($this->languages->removeElement($language)) {
            // set the owning side to null (unless already changed)
            if ($language->getCv() === $this) {
                $language->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CvReferences>
     */
    public function getCvReferences(): Collection
    {
        return $this->cv_references;
    }

    public function addCvReference(CvReferences $cvReference): self
    {
        if (!$this->cv_references->contains($cvReference)) {
            $this->cv_references->add($cvReference);
            $cvReference->setCv($this);
        }

        return $this;
    }

    public function removeCvReference(CvReferences $cvReference): self
    {
        if ($this->cv_references->removeElement($cvReference)) {
            // set the owning side to null (unless already changed)
            if ($cvReference->getCv() === $this) {
                $cvReference->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CvWebLinks>
     */
    public function getUrls(): Collection
    {
        return $this->urls;
    }

    public function addUrl(CvWebLinks $url): self
    {
        if (!$this->urls->contains($url)) {
            $this->urls->add($url);
            $url->setCv($this);
        }

        return $this;
    }

    public function removeUrl(CvWebLinks $url): self
    {
        if ($this->urls->removeElement($url)) {
            // set the owning side to null (unless already changed)
            if ($url->getCv() === $this) {
                $url->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CvEducation>
     */
    public function getEducations(): Collection
    {
        return $this->educations;
    }

    public function addEducation(CvEducation $education): self
    {
        if (!$this->educations->contains($education)) {
            $this->educations->add($education);
            $education->setCv($this);
        }

        return $this;
    }

    public function removeEducation(CvEducation $education): self
    {
        if ($this->educations->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getCv() === $this) {
                $education->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CvJobExperience>
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(CvJobExperience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences->add($experience);
            $experience->setCv($this);
        }

        return $this;
    }

    public function removeExperience(CvJobExperience $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getCv() === $this) {
                $experience->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CvPicture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(CvPicture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setCv($this);
        }

        return $this;
    }

    public function removePicture(CvPicture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getCv() === $this) {
                $picture->setCv(null);
            }
        }

        return $this;
    }

}
