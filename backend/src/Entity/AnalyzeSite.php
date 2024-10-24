<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class AnalyzeSite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $url = null;

    #[ORM\Column]
    private ?float $poidsTotal = null;

    #[ORM\Column]
    private ?int $nbRequetes = null;

    #[ORM\Column]
    private ?float $empreinteCarbone = null;

    #[ORM\Column]
    private ?float $empreinteEau = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAnalyse = null;

    #[ORM\Column]
    private ?float $score = null;

    #[ORM\Column]
    private ?bool $optimiserImages = null;

    #[ORM\Column]
    private ?bool $reduireRequettes = null;

    #[ORM\Column(length: 1)]
    private ?string $note = null;

    #[ORM\Column(length: 255)]
    private ?string $appreciation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getPoidsTotal(): ?float
    {
        return $this->poidsTotal;
    }

    public function setPoidsTotal(float $poidsTotal): static
    {
        $this->poidsTotal = $poidsTotal;

        return $this;
    }

    public function getNbRequetes(): ?int
    {
        return $this->nbRequetes;
    }

    public function setNbRequetes(int $nbRequetes): static
    {
        $this->nbRequetes = $nbRequetes;

        return $this;
    }

    public function getEmpreinteCarbone(): ?float
    {
        return $this->empreinteCarbone;
    }

    public function setEmpreinteCarbone(float $empreinteCarbone): static
    {
        $this->empreinteCarbone = $empreinteCarbone;

        return $this;
    }

    public function getEmpreinteEau(): ?float
    {
        return $this->empreinteEau;
    }

    public function setEmpreinteEau(float $empreinteEau): static
    {
        $this->empreinteEau = $empreinteEau;

        return $this;
    }

    public function getDateAnalyse(): ?\DateTimeInterface
    {
        return $this->dateAnalyse;
    }

    public function setDateAnalyse(\DateTimeInterface $dateAnalyse): static
    {
        $this->dateAnalyse = $dateAnalyse;

        return $this;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(float $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function isOptimiserImages(): ?bool
    {
        return $this->optimiserImages;
    }

    public function setOptimiserImages(bool $optimiserImages): static
    {
        $this->optimiserImages = $optimiserImages;

        return $this;
    }

    public function isReduireRequettes(): ?bool
    {
        return $this->reduireRequettes;
    }

    public function setReduireRequettes(bool $reduireRequettes): static
    {
        $this->reduireRequettes = $reduireRequettes;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getAppreciation(): ?string
    {
        return $this->appreciation;
    }

    public function setAppreciation(string $appreciation): static
    {
        $this->appreciation = $appreciation;

        return $this;
    }
}