<?php

namespace App\Entity;

use App\Repository\FruitsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitsRepository::class)]
class Fruits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $family = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $f_order = null;

    #[ORM\Column]
    private ?int $fruit_id = null;

    #[ORM\Column]
    private ?float $carbohydrates = null;

    #[ORM\Column]
    private ?float $protein = null;

    #[ORM\Column]
    private ?float $fat = null;

    #[ORM\Column]
    private ?float $calories = null;

    #[ORM\Column]
    private ?float $sugar = null;

    #[ORM\Column]
    private ?bool $is_favorite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(?string $genus): self
    {
        $this->genus = $genus;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(?string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getFOrder(): ?string
    {
        return $this->f_order;
    }

    public function setFOrder(?string $f_order): self
    {
        $this->f_order = $f_order;

        return $this;
    }

    public function getFruitId(): ?int
    {
        return $this->fruit_id;
    }

    public function setFruitId(int $fruit_id): self
    {
        $this->fruit_id = $fruit_id;

        return $this;
    }

    public function getCarbohydrates(): ?float
    {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(float $carbohydrates): self
    {
        $this->carbohydrates = $carbohydrates;

        return $this;
    }

    public function getProtein(): ?float
    {
        return $this->protein;
    }

    public function setProtein(float $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getFat(): ?float
    {
        return $this->fat;
    }

    public function setFat(float $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getCalories(): ?float
    {
        return $this->calories;
    }

    public function setCalories(float $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getSugar(): ?float
    {
        return $this->sugar;
    }

    public function setSugar(float $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }

    public function isIsFavorite(): ?bool
    {
        return $this->is_favorite;
    }

    public function setIsFavorite(bool $is_favorite): self
    {
        $this->is_favorite = $is_favorite;

        return $this;
    }
}
