<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CVRepository::class)
 */
class CV
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Experience;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Formation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     maxSize = "4096k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @ORM\OneToOne(targetEntity=DemandeFormateur::class, cascade={"persist", "remove"}, mappedBy="cv")
     * @ORM\JoinColumn(nullable=true)
     */
    private $CVusers;
    /**
     * @ORM\OneToOne(targetEntity=DemandeFormateur::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $demandeformateur;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titredeprofil;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExperience(): ?string
    {
        return $this->Experience;
    }

    public function setExperience(string $Experience): self
    {
        $this->Experience = $Experience;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->Formation;
    }

    public function setFormation(string $Formation): self
    {
        $this->Formation = $Formation;

        return $this;
    }

    public function getCVusers(): ?string
    {
        return $this->CVusers;
    }

    public function setCVusers(string $CVusers): self
    {
        $this->CVusers = $CVusers;

        return $this;
    }

    public function getDemandeformateur(): ?DemandeFormateur
    {
        return $this->demandeformateur;
    }

    public function setDemandeformateur(DemandeFormateur $demandeformateur): self
    {
        $this->demandeformateur = $demandeformateur;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTitredeprofil(): ?string
    {
        return $this->titredeprofil;
    }

    public function setTitredeprofil(string $titredeprofil): self
    {
        $this->titredeprofil = $titredeprofil;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
