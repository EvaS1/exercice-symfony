<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */

use Symfony\Component\Validator\Constraints as Assert;

class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nomVille;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ami", mappedBy="relation")
     */
    private $ami;

    public function __construct()
    {
        $this->ami = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getNomVille(): ?string
    {
        return $this->nomVille;
    }

    public function setNomVille(string $nomVille): self
    {
        $this->nomVille = $nomVille;

        return $this;
    }

    /**
     * @return Collection|Ami[]
     */
    public function getAmi(): Collection
    {
        return $this->ami;
    }

    public function addAmi(Ami $ami): self
    {
        if (!$this->ami->contains($ami)) {
            $this->ami[] = $ami;
            $ami->setRelation($this);
        }

        return $this;
    }

    public function removeAmi(Ami $ami): self
    {
        if ($this->ami->contains($ami)) {
            $this->ami->removeElement($ami);
            // set the owning side to null (unless already changed)
            if ($ami->getRelation() === $this) {
                $ami->setRelation(null);
            }
        }

        return $this;
    }
}
