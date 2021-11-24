<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 * @ORM\Table(name="personnes",
 *            uniqueConstraints={
 *                  @ORM\UniqueConstraint(name="search_idx", 
 *                                        columns={"email"})})
 */

 class Personne
         {
             /**
              * @ORM\Id
              * @ORM\GeneratedValue
              * @ORM\Column(type="integer")
              */
             private $id;
         
             /**
              * @ORM\Column(type="string", length=60, nullable=true)
              */
             private $nom;
         
             /**
              * @ORM\Column(type="string", length=60, nullable=true)
              */
             private $prenom;
           
             /**
              * @ORM\Column(type="string", length=30, nullable=true)
              */
             private $sexe;
         
             /**
              * @ORM\Column(type="string", length=60)
              */
             private $email;
      
             /**
              * @ORM\OneToOne(targetEntity=Adresse::class, cascade={"persist", "remove"})
              */
             private $adresse;
             
             // + les getters et setters
             
             public function getId(): ?int
             {
                 return $this->id;
             }
         
             public function getNom(): ?string
             {
                 return $this->nom;
             }
         
             public function setNom(?string $nom): self
             {
                 $this->nom = $nom;
         
                 return $this;
             }
         
             public function getPrenom(): ?string
             {
                 return $this->prenom;
             }
         
             public function setPrenom(?string $prenom): self
             {
                 $this->prenom = $prenom;
         
                 return $this;
             }
         
             public function getSexe(): ?string
             {
                 return $this->sexe;
             }
         
             public function setSexe(?string $sexe): self
             {
                 $this->sexe = $sexe;
         
                 return $this;
             }
         
             public function getEmail(): ?string
             {
                 return $this->email;
             }
         
             public function setEmail(string $email): self
             {
                 $this->email = $email;
         
                 return $this;
             }
   
             public function getAdresse(): ?Adresse
             {
                 return $this->adresse;
             }

             public function setAdresse(?Adresse $adresse): self
             {
                 $this->adresse = $adresse;

                 return $this;
             }
         }
