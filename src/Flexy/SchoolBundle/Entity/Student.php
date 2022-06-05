<?php

namespace App\Flexy\SchoolBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\SchoolBundle\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
#[ApiResource]
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $registrationAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fatherName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motherName;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $birthAt;

    /**
     * @ORM\ManyToOne(targetEntity=SchoolClass::class, inversedBy="students")
     */
    private $schoolClass;

    /**
     * @ORM\ManyToOne(targetEntity=StudentParent::class, inversedBy="students")
     */
    private $studentParent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Punishment::class, mappedBy="student")
     */
    private $punishments;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="student")
     */
    private $reclamations;

    /**
     * @ORM\OneToMany(targetEntity=Bulletin::class, mappedBy="student")
     */
    private $bulletins;

    public function __construct()
    {
        $this->punishments = new ArrayCollection();
        $this->reclamations = new ArrayCollection();
        $this->bulletins = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->firstName." ".$this->lastName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getRegistrationAt(): ?\DateTimeImmutable
    {
        return $this->registrationAt;
    }

    public function setRegistrationAt(?\DateTimeImmutable $registrationAt): self
    {
        $this->registrationAt = $registrationAt;

        return $this;
    }

    public function getFatherName(): ?string
    {
        return $this->fatherName;
    }

    public function setFatherName(?string $fatherName): self
    {
        $this->fatherName = $fatherName;

        return $this;
    }

    public function getMotherName(): ?string
    {
        return $this->motherName;
    }

    public function setMotherName(?string $motherName): self
    {
        $this->motherName = $motherName;

        return $this;
    }

    public function getBirthAt(): ?\DateTimeImmutable
    {
        return $this->birthAt;
    }

    public function setBirthAt(?\DateTimeImmutable $birthAt): self
    {
        $this->birthAt = $birthAt;

        return $this;
    }

    public function getSchoolClass(): ?SchoolClass
    {
        return $this->schoolClass;
    }

    public function setSchoolClass(?SchoolClass $schoolClass): self
    {
        $this->schoolClass = $schoolClass;

        return $this;
    }

    public function getStudentParent(): ?StudentParent
    {
        return $this->studentParent;
    }

    public function setStudentParent(?StudentParent $studentParent): self
    {
        $this->studentParent = $studentParent;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Punishment>
     */
    public function getPunishments(): Collection
    {
        return $this->punishments;
    }

    public function addPunishment(Punishment $punishment): self
    {
        if (!$this->punishments->contains($punishment)) {
            $this->punishments[] = $punishment;
            $punishment->setStudent($this);
        }

        return $this;
    }

    public function removePunishment(Punishment $punishment): self
    {
        if ($this->punishments->removeElement($punishment)) {
            // set the owning side to null (unless already changed)
            if ($punishment->getStudent() === $this) {
                $punishment->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reclamation>
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): self
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations[] = $reclamation;
            $reclamation->setStudent($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getStudent() === $this) {
                $reclamation->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bulletin>
     */
    public function getBulletins(): Collection
    {
        return $this->bulletins;
    }

    public function addBulletin(Bulletin $bulletin): self
    {
        if (!$this->bulletins->contains($bulletin)) {
            $this->bulletins[] = $bulletin;
            $bulletin->setStudent($this);
        }

        return $this;
    }

    public function removeBulletin(Bulletin $bulletin): self
    {
        if ($this->bulletins->removeElement($bulletin)) {
            // set the owning side to null (unless already changed)
            if ($bulletin->getStudent() === $this) {
                $bulletin->setStudent(null);
            }
        }

        return $this;
    }
}
