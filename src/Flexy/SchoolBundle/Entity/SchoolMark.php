<?php

namespace App\Flexy\SchoolBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\SchoolBundle\Repository\SchoolMarkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolMarkRepository::class)
 */
#[ApiResource]
class SchoolMark
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=SchoolClassSubject::class, mappedBy="schoolMark")
     */
    private $schoolClassSubject;

    /**
     * @ORM\ManyToOne(targetEntity=SchoolSubject::class, inversedBy="schoolMarks")
     */
    private $schoolSubject;

    /**
     * @ORM\ManyToOne(targetEntity=Bulletin::class, inversedBy="schoolMarks")
     */
    private $bulletin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->schoolClassSubject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, SchoolClassSubject>
     */
    public function getSchoolClassSubject(): Collection
    {
        return $this->schoolClassSubject;
    }

    public function addSchoolClassSubject(SchoolClassSubject $schoolClassSubject): self
    {
        if (!$this->schoolClassSubject->contains($schoolClassSubject)) {
            $this->schoolClassSubject[] = $schoolClassSubject;
            $schoolClassSubject->setSchoolMark($this);
        }

        return $this;
    }

    public function removeSchoolClassSubject(SchoolClassSubject $schoolClassSubject): self
    {
        if ($this->schoolClassSubject->removeElement($schoolClassSubject)) {
            // set the owning side to null (unless already changed)
            if ($schoolClassSubject->getSchoolMark() === $this) {
                $schoolClassSubject->setSchoolMark(null);
            }
        }

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

    public function getBulletin(): ?Bulletin
    {
        return $this->bulletin;
    }

    public function setBulletin(?Bulletin $bulletin): self
    {
        $this->bulletin = $bulletin;

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
}
