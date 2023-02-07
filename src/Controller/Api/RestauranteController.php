<?php

namespace App\Controller\Api;

use App\Repository\RestauranteRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/restaurante")
 */
class RestauranteController extends AbstractFOSRestController
{
    private $repo;

    public function __construct(RestauranteRepository $repo){
        $this->repo = $repo;
    }


    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View (serializerGroups={"restaurante"}, serializerEnableMaxDepthChecks=true)
     */
    public function getRestaurante(Request $request){

        return $this->repo->find($request->get('id'));
    }

    /**
     * @Rest\Post (path="/filtered")
     * @Rest\View (serializerGroups={"res_filtered"}, serializerEnableMaxDepthChecks=true)
     */
    public function getRestaurantesBy(Request $request){
        $dia = $request->get('dia');
        $hora = $request->get('hora');
        $idMunicipio = $request->get('municipio');


        $restaurantes = $this->repo->findByDayTimeMunicipio($dia,$hora,$idMunicipio);
        return $restaurantes;

    }



}