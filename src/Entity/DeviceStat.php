<?php

namespace App\Entity;

use App\Repository\DeviceStatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviceStatRepository::class)]
class DeviceStat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $deviceType = null;

    #[ORM\Column]
    private ?int $count = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceType(): ?string
    {
        return $this->deviceType;
    }

    public function setDeviceType(string $deviceType): static
    {
        $this->deviceType = $deviceType;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): static
    {
        $this->count = $count;

        return $this;
    }
}
