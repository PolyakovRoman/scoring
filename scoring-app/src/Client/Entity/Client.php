<?php

namespace App\Client\Entity;

use App\Client\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Enum\EducationLevel;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[UniqueEntity(fields: ['email'],message: 'Пользователь с таким email уже существует')]
#[UniqueEntity(fields: ['phone'],message: 'Пользователь с таким номером телефона уже существует')]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Заполните имя')]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[Assert\NotBlank(message: 'Заполните фамилию')]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[Assert\NotBlank(message: 'Заполните телефон')]
    #[Assert\Regex(pattern: '/^(\\+7|7|8)\\d{10}$/', message: 'Введите корректный российский номер телефона')]
    #[ORM\Column(length: 20, unique: true)]
    private ?string $phone = null;

    #[Assert\NotBlank(message: 'Заполните Email')]
    #[Assert\Email(message: 'Введите корректный email')]
    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: "string", enumType: EducationLevel::class)]
    private ?EducationLevel $education = null;

    #[ORM\Column]
    private ?bool $consent = false;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEducation(): ?EducationLevel
    {
        return $this->education;
    }

    public function setEducation(EducationLevel $education): static
    {
        $this->education = $education;

        return $this;
    }

    public function isConsent(): ?bool
    {
        return $this->consent;
    }

    public function setConsent(bool $consent): static
    {
        $this->consent = $consent;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
