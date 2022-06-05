<?php

namespace App\Flexy\SchoolBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\SchoolBundle\Repository\SchoolClassSubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolClassSubjectRepository::class)
 */
#[ApiResource]
class SchoolClassSubject
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
     * @ORM\ManyToOne(targetEntity=SchoolClass::class, inversedBy="schoolClassSubjects")
     */
    private $schoolClass;

    /**
     * @ORM\ManyToOne(targetEntity=SchoolSubject::class, inversedBy="schoolClassSubjects")
     */
    private $schoolSubject;

    /**
     * @ORM\ManyToOne(targetEntity=Teacher::class, inversedBy="schoolClassSubjects")
     */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity=HomeWork::class, mappedBy="schoolSubjectClass")
     */
    private $homeWorks;

    /**
     * @ORM\ManyToOne(targetEntity=SchoolMark::class, inversedBy="schoolClassSubject")
     */
    private $schoolMark;

    /**
     * @ORM\OneToMany(targetEntity=Exam::class, mappedBy="schoolClassSubject")
     */
    private $exams;

    public function __construct()
    {
        $this->homeWorks = new ArrayCollection();
        $this->exams = new ArrayCollection();
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

    public function getSchoolClass(): ?SchoolClass
    {
        return $this->schoolClass;
    }

    public function setSchoolClass(?SchoolClass $schoolClass): self
    {
        $this->schoolClass = $schoolClass;

        return $this;
    }

    public function getSchoolSubject(): ?SchoolSubject
    {
        return $this->schoolSubject;
    }

    public function setSchoolSubject(?SchoolSubject $schoolSubject): self
    {
        $this->schoolSubject = $schoolSubject;

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * @return Collection<int, HomeWork>
     */
    public function getHomeWorks(): Collection
    {
        return $this->homeWorks;
    }

    public function addHomeWork(HomeWork $homeWork): self
    {
        if (!$this->homeWorks->contains($homeWork)) {
            $this->homeWorks[] = $homeWork;
            $homeWork->setSchoolSubjectClass($this);
        }

        return $this;
    }

    public function removeHomeWork(HomeWork $homeWork): self
    {
        if ($this->homeWorks->removeElement($homeWork)) {
            // set the owning side to null (unless already changed)
            if ($homeWork->getSchoolSubjectClass() === $this) {
                $homeWork->setSchoolSubjectClass(null);
            }
        }

        return $this;
    }

    public function getSchoolMark(): ?SchoolMark
    {
        return $this->schoolMark;
    }

    public function setSchoolMark(?SchoolMark $schoolMark): self
    {
        $this->schoolMark = $schoolMark;

        return $this;
    }

    /**
     * @return Collection<int, Exam>
     */
    public function getExams(): Collection
    {
        return $this->exams;
    }

    public function addExam(Exam $exam): self
    {
        if (!$this->exams->contains($exam)) {
            $this->exams[] = $exam;
            $exam->setSchoolClassSubject($this);
        }

        return $this;
    }

    public function removeExam(Exam $exam): self
    {
        if ($this->exams->removeElement($exam)) {
            // set the owning side to null (unless already changed)
            if ($exam->getSchoolClassSubject() === $this) {
                $exam->setSchoolClassSubject(null);
            }
        }

        return $this;
    }
}
