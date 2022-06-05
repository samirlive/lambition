<?php

namespace App\Flexy\SchoolBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\SchoolBundle\Repository\SchoolSubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolSubjectRepository::class)
 */
#[ApiResource]
class SchoolSubject
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=SchoolClass::class, inversedBy="schoolSubjects",cascade={"persist"})
     */
    private $schoolClass;

    /**
     * @ORM\OneToMany(targetEntity=SchoolClassSubject::class, mappedBy="schoolSubject")
     */
    private $schoolClassSubjects;

    /**
     * @ORM\ManyToMany(targetEntity=Teacher::class, inversedBy="schoolSubjects")
     */
    private $teachers;

    /**
     * @ORM\OneToMany(targetEntity=SchoolMark::class, mappedBy="schoolSubject")
     */
    private $schoolMarks;

    public function __construct()
    {
        $this->schoolClass = new ArrayCollection();
        $this->schoolClassSubjects = new ArrayCollection();
        $this->teachers = new ArrayCollection();
        $this->schoolMarks = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * @return Collection<int, SchoolClass>
     */
    public function getSchoolClass(): Collection
    {
        return $this->schoolClass;
    }

    public function addSchoolClass(SchoolClass $schoolClass): self
    {
        if (!$this->schoolClass->contains($schoolClass)) {
            $this->schoolClass[] = $schoolClass;
        }

        return $this;
    }

    public function removeSchoolClass(SchoolClass $schoolClass): self
    {
        $this->schoolClass->removeElement($schoolClass);

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
            $schoolClassSubject->setSchoolSubject($this);
        }

        return $this;
    }

    public function removeSchoolClassSubject(SchoolClassSubject $schoolClassSubject): self
    {
        if ($this->schoolClassSubjects->removeElement($schoolClassSubject)) {
            // set the owning side to null (unless already changed)
            if ($schoolClassSubject->getSchoolSubject() === $this) {
                $schoolClassSubject->setSchoolSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Teacher>
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teacher $teacher): self
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers[] = $teacher;
        }

        return $this;
    }

    public function removeTeacher(Teacher $teacher): self
    {
        $this->teachers->removeElement($teacher);

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
            $schoolMark->setSchoolSubject($this);
        }

        return $this;
    }

    public function removeSchoolMark(SchoolMark $schoolMark): self
    {
        if ($this->schoolMarks->removeElement($schoolMark)) {
            // set the owning side to null (unless already changed)
            if ($schoolMark->getSchoolSubject() === $this) {
                $schoolMark->setSchoolSubject(null);
            }
        }

        return $this;
    }
}
