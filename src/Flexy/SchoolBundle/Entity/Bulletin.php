<?php

namespace App\Flexy\SchoolBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BulletinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BulletinRepository::class)
 */
#[ApiResource]
class Bulletin
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
     * @ORM\OneToMany(targetEntity=SchoolMark::class, mappedBy="bulletin")
     */
    private $schoolMarks;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="bulletins")
     */
    private $student;

    public function __construct()
    {
        $this->schoolMarks = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, SchoolMark>
     */
    public function getSchoolMarks(): Collection
    {
        return $this->schoolMarks;
    }

    public function addSchoolMark(SchoolMark $schoolMark): self
    {
        if (!$this->schoolMarks->contains($schoolMark)) {
            $this->schoolMarks[] = $schoolMark;
            $schoolMark->setBulletin($this);
        }

        return $this;
    }

    public function removeSchoolMark(SchoolMark $schoolMark): self
    {
        if ($this->schoolMarks->removeElement($schoolMark)) {
            // set the owning side to null (unless already changed)
            if ($schoolMark->getBulletin() === $this) {
                $schoolMark->setBulletin(null);
            }
        }

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
