<?php

    namespace App\DataProvider;

use App\Entity\Stagiaire;
use App\Repository\StagiaireRepository;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class StagiairesDataProvider implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface{

    private $request;
    private $stagiaireRepository;

    public function __construct(RequestStack $req, StagiaireRepository $stagiaireRepository)
    {
        $this->stagiaireRepository = $stagiaireRepository;
        $this->request = $req;
    }

    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = [])
    {
        // 1 . Afficher tous les stagiaires 
        if(empty($this->request->getCurrentRequest()->get('nom'))){
            $data = $this->stagiaireRepository->findAll();
            return $data;
        }

        $nom = $this->request->getCurrentRequest()->get('nom');
        $data = $this->stagiaireRepository->findOneByName($nom);  
        return $data;
    }

    public function getItem(string $resourceClass, $id, ?string $operationName = null, array $context = [])
    {
        // Récupère un stagiaire par son id 
        if( $operationName == 'getById'){
            $data = $this->stagiaireRepository->findOneById($id);
            return $data;
        }
  
    }

    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        // désactiver rapidement le provider personalisé,
        // penser a faire un switch pour avoir à la fois les opérations par défaut, à la fois les customisées
        // return false;

        switch($operationName){

            # Default Operations

            case 'get':
                return false;
                break;

            case 'post':
                return false;
                break;

            case 'put':
                return false;
                break;

            case 'patch':
                return false;
                break;

            case 'delete':
                return false;
                break;

            # Custom Operations

            case 'getByName':
                return true;
                break;

            # Default

            default:
                return false;
            
        }
        // if($operationName == 'get'){
        //     return false;
        // }
        // return $resourceClass === Stagiaire::class;


        // if ($resourceClass === Stagiaire::class){
        //     return true;
        // }
        // else {
        //     return false;    
        // }
    }

}
