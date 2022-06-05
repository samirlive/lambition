<?php

namespace App\Flexy\SchoolBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HomeWorkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomeWorkRepository::class)
 */
#[ApiResource]
class HomeWork
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=SchoolClassSubject::class, inversedBy="homeWorks")
     */
    private $schoolSubjectClass;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getSchoolSubjectClass(): ?SchoolClassSubject
    {
        return $this->schoolSubjectClass;
    }

    public function setSchoolSubjectClass(?SchoolClassSubject $schoolSubjectClass): self
    {
        $this->schoolSubjectClass = $schoolSubjectClass;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
