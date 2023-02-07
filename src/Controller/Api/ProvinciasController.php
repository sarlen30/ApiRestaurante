<?php

namespace App\Controller\Api;

use App\Repository\MunicipiosRepository;
use App\Repository\ProvinciasRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route ("/provincias")
 */
class ProvinciasController extends AbstractFOSRestController
{
    private $repoP;
    private $repoM;

    public function __construct(ProvinciasRepository $repoP, MunicipiosRepository $repoM){
        $this->repoM = $repoM;
        $this->repoP = $repoP;
    }

    /**
     * @Rest\Get (path="/")
     * @Rest\View (serializerGroups={"provincias"} ,serializerEnableMaxDepthChecks= true)
     */
    public function getProvincias(){
        return $this->repoP->findAll();
    }

    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View (serializerGroups={"municipios"}, serializerEnableMaxDepthChecks= true)
     */
    public function getMunicipiosByProvincia(Request $request){
        return $this->repoM->findBy(['idProvincia'=>$request->get('id')]);
    }



}