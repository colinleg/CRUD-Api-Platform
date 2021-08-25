<?php 

namespace App\Controller;

use App\Entity\Stagiaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class StagiairesImageController extends AbstractController
{
    public function __construct()
    {
        
    }

    public function __invoke(Request $request)
    {

        // dd($request->attributes->get('data'));
        $stagiaire = $request->attributes->get('data');

        // if(!($stagiaire instanceof Stagiaire)){
        //     throw new \RuntimeException('Un objet de type Stagiaire est attendu');
        // }

        $file = $request->files->get('image');
        $stagiaire->setFile($request->files->get('image'));
        $stagiaire->setUpdatedAt( new \DateTimeImmutable());

        // dd($file, $stagiaire);

        return $stagiaire;
    }
}