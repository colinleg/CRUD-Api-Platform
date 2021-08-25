<?php

namespace App\Entity;

$context = ['summary' => 'collection custom : Récupérer un ( ou plusieurs ) stagiaire(s)  par son/leurs nom(s)'];
        

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\StagiairesImageController;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=App\Repository\StagiaireRepository::class)
 * @Vich\Uploadable()
 */
#[ApiResource(
    paginationEnabled: false,
    collectionOperations: [
        'get' => [
            'method' => 'get',
            'openapi_context' => [
                'summary' => 'collection default : Récupérer tous les stagiaires'
            ]
        ],
        'post' => [
            'method' => 'post',
            'openapi_context' => [
                'summary' =>'collection default : Créer un stagiaire'
            ]
        ],
        'getByName' => [
            'method' => 'get',
            'path' => 'stagiaires/getByName',
            'openapi_context' => [ 
                'summary' => 'collection custom : Récupérer un ( ou plusieurs ) stagiaire(s)  par son/leurs nom(s)',
                'parameters' => [
                    [
                        'name' => "nom",
                        'in' => 'query',
                        'description' => 'le nom à rechercher',
                        'required' => true
                    ]
                ],
                'responses' => [
                    '200' => [
                        'description' => 'Le stagiaire a été trouvé dans la base de donnée',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'object',
                                    'example' => '{
                                                        "@context": "/api/contexts/Stagiaire",
                                                        "@id": "/api/stagiaires/30",
                                                        "@type": "Stagiaire",
                                                        "id": 30,
                                                        "nom": "nom1",
                                                        "prenom": "prenom1",
                                                        "telephone": "0116457894",
                                                        "adresse": "1rue des stagiaires",
                                                        "diplôme": "",
                                                        "date_naissance": "2000-06-01T00:00:00+02:00",
                                                        "contrat": true,
                                                        "photo": "images/image1.jpg",
                                                        "description": "Un stagiaire un peu comme les autres",
                                                        "dateNaissance": "2000-06-01T00:00:00+02:00"
                                                    }'
                                ]
                            ]
                        ]

                    ],
                    '400' => [
                        'description' => 'Erreur dans la requête : le paramètre doit être une chaîne de caractères.'
                    ],
                    '404' => [
                        'description' => 'Le stagiaire n\'a pas été trouvé dans la base de donnée.'
                    ],
                    '5XX' => [
                        'description' => 'Une erreur est survenue dans le serveur'
                    ] 
                ]
            ]
        ],
        
    ],
    itemOperations: [
        'put' => [
            'method' => 'put',
            'openapi_context' => [
                'summary' => 'item default : Modifier un stagiaire'
            ]

        ],
        'patch' => [
                    'method' => 'patch',
                    'openapi_context' => [
                        'summary' => 'item default : Modifier un stagiaire'
                    ]

                ],


        'delete' => [
            'method' => 'delete',
            'openapi_context' => [
                'summary' => 'item default : Supprimer un stagiaire'
            ]
        ],

        'get' => [
            'method' => 'get',
            'openapi_context' => [
                'summary' => 'item default : Récupérer un stagiaire par son id',
                'parameters' => [
                    [
                    'name' => 'id',
                    'description' => 'l\'id à rechercher',
                    'type' => 'integer',
                    'in' => 'path',
                    'required' => true
                    ]
                ]
            ]
        ],

        'uploadImg' => [
                    'method' => 'post',
                    'path' => '/stagiaires/{id}/image',
                    'deserialize' => false,
                    'controller' => StagiairesImageController::class,

        ]

        // 'post' => [
        //     'method' => 'post',
        //     'openapi_context' => [
        //         'summary' => 'item default : Créer un stagiaire par son id'
        //     ]
        // ],
    ]
)]
class Stagiaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[ApiProperty(identifier: true)]
    private $id;

    /**
     *
     * @var File|null 
     * @Vich\UploadableField(mapping="post_image", fileNameProperty="fileName")
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $diplôme;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="boolean")
     */
    private $contrat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fileName;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * Chemin de l'image 
     *
     * @var string|null
     */
    private $fileUrl;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
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

    public function getDiplôme(): ?string
    {
        return $this->diplôme;
    }

    public function setDiplôme(string $diplôme): self
    {
        $this->diplôme = $diplôme;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getContrat(): ?bool
    {
        return $this->contrat;
    }

    public function setContrat(bool $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl($fileUrl): self
    {
        $this->fileUrl = $fileUrl;
        return $this;
    }
}
