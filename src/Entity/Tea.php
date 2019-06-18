<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeaRepository")
 */
class Tea
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $origin;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reader", mappedBy="tea")
     */
    private $readers;

    public function __construct()
    {
        $this->readers = new ArrayCollection();
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

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|Reader[]
     */
    public function getReaders(): Collection
    {
        return $this->readers;
    }

    public function addReader(Reader $reader): self
    {
        if (!$this->readers->contains($reader)) {
            $this->readers[] = $reader;
            $reader->setTea($this);
        }

        return $this;
    }

    public function removeReader(Reader $reader): self
    {
        if ($this->readers->contains($reader)) {
            $this->readers->removeElement($reader);
            // set the owning side to null (unless already changed)
            if ($reader->getTea() === $this) {
                $reader->setTea(null);
            }
        }

        return $this;
    }
    public function __toString(){
      return $this->name;
    }
}
