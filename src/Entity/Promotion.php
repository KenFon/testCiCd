<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 */
class Promotion
{
    /**
     * var UuidInterface|null
     * 
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="date")
     */
    private $end;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="promotions")
     * @ApiSubResource(maxDepth=1)
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExceptionDate", mappedBy="promotion", orphanRemoval=true)
     * 
     */
    private $exceptions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Regroupement", inversedBy="promotions")
     */
    private $regroupements;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->exceptions = new ArrayCollection();
        $this->regroupements = new ArrayCollection();
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

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addPromotion($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removePromotion($this);
        }

        return $this;
    }

    /**
     * @return Collection|ExceptionDate[]
     */
    public function getExceptions(): Collection
    {
        return $this->exceptions;
    }

    public function addException(ExceptionDate $exception): self
    {
        if (!$this->exceptions->contains($exception)) {
            $this->exceptions[] = $exception;
            $exception->setPromotion($this);
        }

        return $this;
    }

    public function removeException(ExceptionDate $exception): self
    {
        if ($this->exceptions->contains($exception)) {
            $this->exceptions->removeElement($exception);
            // set the owning side to null (unless already changed)
            if ($exception->getPromotion() === $this) {
                $exception->setPromotion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Regroupement[]
     */
    public function getRegroupements(): Collection
    {
        return $this->regroupements;
    }

    public function addRegroupement(Regroupement $regroupement): self
    {
        if (!$this->regroupements->contains($regroupement)) {
            $this->regroupements[] = $regroupement;
        }

        return $this;
    }

    public function removeRegroupement(Regroupement $regroupement): self
    {
        if ($this->regroupements->contains($regroupement)) {
            $this->regroupements->removeElement($regroupement);
        }

        return $this;
    }
}
