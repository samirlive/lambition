<?php

namespace App\Flexy\SchoolBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\SchoolBundle\Repository\SchoolClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolClassRepository::class)
 */
#[ApiResource]
class SchoolClass
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
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="schoolClass",cascade={"persist"})
     */
    private $students;

    /**
     * @ORM\ManyToMany(targetEntity=SchoolSubject::class, mappedBy="schoolClass",cascade={"persist"})
     */
    private $schoolSubjects;

    /**
     * @ORM\OneToMany(targetEntity=SchoolClassSubject::class, mappedBy="schoolClass")
     */
    private $schoolClassSubjects;

    /**
     * @ORM\ManyToOne(targetEntity=SchoolYear::class, inversedBy="schoolClasses")
     */
    private $schoolYear;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->schoolSubjects = new ArrayCollection();
        $this->schoolClassSubjects = new ArrayCollection();
    }


    public function __toString()
    {
        return (string)$this->description;
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
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setSchoolClass($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getSchoolClass() === $this) {
                $student->setSchoolClass(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SchoolSubject>
     */
    public function getSchoolSubjects(): Collection
    {
        return $this->schoolSubjects;
    }

    public function addSchoolSubject(SchoolSubject $schoolSubject): self
    {
        if (!$this->schoolSubjects->contains($schoolSubject)) {
            $this->schoolSubjects[] = $schoolSubject;
            $schoolSubject->addSchoolClass($this);
        }

        return $this;
    }

    public function removeSchoolSubject(SchoolSubject $schoolSubject): self
    {
        if ($this->schoolSubjects->removeElement($schoolSubject)) {
            $schoolSubject->removeSchoolClass($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, SchoolClassSubject>
     */
    public function getSchoolClassSubjects(): Collection
    {
        return $this->schoolClassSubjects;
    }

    public function addSchoolClassSubject(SchoolClassSubject $schoolClassSubject): self
    {
        if (!$this->schoolClassSubjects->contains($schoolClassSubject)) {
            $this->schoolClassSubjects[] = $schoolClassSubject;
            $schoolClassSubject->setSchoolClass($this);
        }

        return $this;
    }

    public function removeSchoolClassSubject(SchoolClassSubject $schoolClassSubject): self
    {
        if ($this->schoolClassSubjects->removeElement($schoolClassSubject)) {
            // set the owning side to null (unless already changed)
            if ($schoolClassSubject->getSchoolClass() === $this) {
                $schoolClassSubject->setSchoolClass(null);
            }
        }

        return $this;
    }

    public function getSchoolYear(): ?SchoolYear
    {
        return $this->schoolYear;
    }

    public function setSchoolYear(?SchoolYear $schoolYear): self
    {
        $this->schoolYear = $schoolYear;

        return $this;
    }
}
