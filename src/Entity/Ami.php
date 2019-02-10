<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AmiRepository")
 */

use Symfony\Component\Validator\Constraints as Assert;

class Ami
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nomAmi;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $prenomAmi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="ami")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAmi(): ?string
    {
        return $this->nomAmi;
    }

    public function setNomAmi(string $nomAmi): self
    {
        $this->nomAmi = $nomAmi;

        return $this;
    }

    public function getPrenomAmi(): ?string
    {
        return $this->prenomAmi;
    }

    public function setPrenomAmi(string $prenomAmi): self
    {
        $this->prenomAmi = $prenomAmi;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
