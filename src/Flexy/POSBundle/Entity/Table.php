<?php

namespace App\Flexy\POSBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\POSBundle\Repository\TableRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=TableRepository::class)
 * @ORM\Table(name="`table`")
 * @ApiResource
 */
class Table
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
     * @ORM\Column(type="float", nullable=true)
     */
    private $canvasX;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $canvasY;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $canvasHeight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $canvasWidth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $backgroundColor;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $canvasScaleX;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $canvasScaleY;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $canvasAngle;

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

    public function getCanvasX(): ?float
    {
        return $this->canvasX;
    }

    public function setCanvasX(?float $canvasX): self
    {
        $this->canvasX = $canvasX;

        return $this;
    }

    public function getCanvasY(): ?float
    {
        return $this->canvasY;
    }

    public function setCanvasY(?float $canvasY): self
    {
        $this->canvasY = $canvasY;

        return $this;
    }

    public function getCanvasHeight(): ?float
    {
        return $this->canvasHeight;
    }

    public function setCanvasHeight(?float $canvasHeight): self
    {
        $this->canvasHeight = $canvasHeight;

        return $this;
    }

    public function getCanvasWidth(): ?float
    {
        return $this->canvasWidth;
    }

    public function setCanvasWidth(?float $canvasWidth): self
    {
        $this->canvasWidth = $canvasWidth;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getCanvasScaleX(): ?float
    {
        return $this->canvasScaleX;
    }

    public function setCanvasScaleX(?float $canvasScaleX): self
    {
        $this->canvasScaleX = $canvasScaleX;

        return $this;
    }

    public function getCanvasScaleY(): ?float
    {
        return $this->canvasScaleY;
    }

    public function setCanvasScaleY(?float $canvasScaleY): self
    {
        $this->canvasScaleY = $canvasScaleY;

        return $this;
    }

    public function getCanvasAngle(): ?float
    {
        return $this->canvasAngle;
    }

    public function setCanvasAngle(?float $canvasAngle): self
    {
        $this->canvasAngle = $canvasAngle;

        return $this;
    }
}
