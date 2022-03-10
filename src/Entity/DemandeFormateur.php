<?php

namespace App\Entity;

use App\Repository\DemandeFormateurRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandeFormateurRepository::class)
 */
class DemandeFormateur

{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank(message="Veuillez renseigner ce champ!")
     * @Assert\Length(
     *     max=30,
     *     maxMessage="Le nom doit contenir au plus 30 carcatères")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank(message="Veuillez renseigner ce champ!")
     * @Assert\Length(
     *     max=30,
     *     maxMessage="Le prénom doit contenir au plus 30 carcatères")
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", length=255)
     * @Assert\Date
     * @Assert\LessThan("today")
     * @Assert\LessThanOrEqual("18 years")
     */
    private $DateDeNaissance;
    /**
     * @ORM\Column(type="string", length=5)
     */
    private $sexe;
    
    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Email (
     *     message = "{{ value }} n'est pas une addresse mail valide, veuillez entrer une adresse sous cette forme: exemple@gmail.com")
     * @Assert\NotBlank(message="Veuillez remplir ce champs !")
     */

    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank(message="Veuillez renseigner ce champ!")
     * @Assert\Length(
     *     max=30,
     *     maxMessage="L'adresse doit contenir au plus 30 carcatères")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(min = 8, max = 10, minMessage = "longueur minimale est 8", maxMessage = "longueur maximale est 10")
     */
    
    private $telephone;

    /**
     * @ORM\OneToOne(targetEntity="CV", cascade={"persist", "remove"},inversedBy="CVusers")
     * @ORM\JoinColumn(nullable=false , onDelete="CASCADE")
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     maxSize = "4096k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     */
     
    private $cv;

   

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $DateDeNaissance): self
    {
        $this->DateDeNaissance = $DateDeNaissance;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }
}
