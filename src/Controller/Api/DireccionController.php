<?php

namespace App\Controller\Api;

use App\Entity\Direccion;
use App\Form\DireccionType;
use App\Repository\ClienteRepository;
use App\Repository\DireccionRepository;
use Doctrine\ORM\Mapping\OrderBy;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Rest\Route("/direccion")
 */

class DireccionController extends AbstractFOSRestController
{

    private $repo;

    public function __construct(DireccionRepository $repo){
        $this->repo = $repo;
    }

    /**
     * @Rest\Post (path="/")
     * @Rest\View (serializerGroups={"post_dir"}, serializerEnableMaxDepthChecks= true)
     */
    public function createDireccion(Request $request){

        $direccion = new Direccion();
        $form = $this->createForm(DireccionType::class, $direccion);
        $form->handleRequest($request);
        if(!$form->isSubmitted() || !$form->isValid()){
            return new JsonResponse('Bad data', Response::HTTP_BAD_REQUEST);
        }
        $this->repo->add($direccion, true);
        return $direccion;
    }


    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View (serializerGroups={"get_dir_cliente"}, serializerEnableMaxDepthChecks= true)
     */
    public function getDireccionesByCliente(Request $request, ClienteRepository $clienteRepository){
        $idCliente = $request->get('id');

        $cliente = $clienteRepository->find($idCliente);

        if(!$cliente){
            return new JsonResponse('No se ha encontrado el cliente', Response::HTTP_NOT_FOUND);
        }

        $direcciones = $this->repo->findBy(['cliente'=> $idCliente]);
        return $direcciones;
    }


    /**
     * @Rest\Patch (path="/{id}")
     * @Rest\View (serializerGroups={"get_dir_cliente"},serializerEnableMaxDepthChecks= true)
     */

    public function updateDireccion(Request $request){
        $idDireccion = $request->get('id');
        $direccion = $this->repo->find($idDireccion);
        if(!$direccion){
            return new JsonResponse('No existe', Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(DireccionType::class,$direccion, ['method'=>$request->getMethod()]);
        $form->handleRequest($request);
        if(!$form->isSubmitted() || !$form->isValid()){
            return $form;
        }
        $this->repo->add($direccion, true);
        return $direccion;
    }

    /**
     * @Rest\Delete (path="/{id}")
     *
     */
    public function deleteDireccion(Request $request){
        $idDireccion = $request->get('id');
        $direccion = $this->repo->find($idDireccion);
        if(!$direccion){
            throw new NotFoundHttpException('No existe la direccion ');
        }
        $this->repo->remove($direccion, true);
        return new Response('Eliminado',Response::HTTP_OK);
    }

}