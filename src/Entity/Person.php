<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass=App\Repository\PersonRepository::class)
 */
class Person
{

    const FUNCTIONS = [
        0 => 'Secrétaire',
        1 => 'Commercial',
        2 => 'Technicien'
    ];

    const SITES = [
        0 => 'Paris',
        1 => 'Toulouse',
        2 => 'Bordeaux'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="integer")
     */
    private $function;

    /**
     * @ORM\Column(type="integer")
     */
    private $site;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->lastname);
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFunction(): ?int
    {
        return $this->function;
    }

    public function setFunction(int $function): self
    {
        $this->function = $function;

        return $this;
    }

    public function getFunctionName(): string
    {
        return self::FUNCTIONS[$this->function];
    }

    public function getSite(): ?int
    {
        return $this->site;
    }

    public function setSite(int $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getSiteName(): string
    {
        return self::SITES[$this->site];
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
