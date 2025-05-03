<?php

namespace App\Entity;

use App\Repository\ReadingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReadingRepository::class)]
class Reading
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $value = null;

    

    #[ORM\ManyToOne(inversedBy: 'readings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ElectrMeter $electrMeter = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getElectrMeter(): ?ElectrMeter
    {
        return $this->electrMeter;
    }

    public function setElectrMeter(?ElectrMeter $electrMeter): static
    {
        $this->electrMeter = $electrMeter;

        return $this;
    }
}
