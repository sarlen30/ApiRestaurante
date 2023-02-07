<?php

namespace App\Controller\Api;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use App\Repository\RestauranteRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Json;


/**
 * @Rest\Route("/categoria")
 */
class CatergoriaController extends AbstractFOSRestController
{

    private $categoriaRepository;

    public function __construct(CategoriaRepository $repo)
    {
        $this->categoriaRepository = $repo;
    }

    /**
     * @Rest\Get (path="/")
     * @Rest\View (serializerGroups={"get_categorias"}, serializerEnableMaxDepthChecks = true)
     */

    public function  getCategorias(){
        return $this->categoriaRepository->findAll();
    }


    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View(serializerGroups={"get_categoria"}, serializerEnableMaxDepthChecks= true)
     */
    public function getCategoria(Request $request){
        $idCategoria = $request->get('id');
        $categoria = $this->categoriaRepository->find($idCategoria);
        if(!$categoria){
            return new JsonResponse('No se ha encontrado categoria', Response::HTTP_NOT_FOUND);
        }
        return $categoria;

    }



    /**
     * @Rest\Post (path="/")
     * @Rest\View (serializerGroups={"post_categoria"}, serializerEnableMaxDepthChecks= true)
     */
    public function createCategoria(Request $request){

        $cat = new Categoria();

        $form = $this->createForm(CategoriaType::class, $cat);

        $form->handleRequest($request);

        if(!$form->isSubmitted() || !$form->isValid() ){
            return $form;
        }


        $this->categoriaRepository->add($cat, true);
        return $cat;
    }


    /**
     * @Rest\Patch(path="/{id}")
     * @Rest\View (serializerGroups={"up_categoria"}, serializerEnableMaxDepthChecks=true)
     */
    public function updateCategoria(Request $request){

        $categoriaId = $request->get('id');


        $categoria = $this->categoriaRepository->find($categoriaId);
        if(!$categoria){
            return new JsonResponse('No se ha encontrado', Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(CategoriaType::class,$categoria,['method'=>$request->getMethod()]);
        $form->handleRequest($request);

        if(!$form->isSubmitted() || !$form->isValid()){
            return new JsonResponse('Bad data', 400);
        }
        $this->categoriaRepository->add($categoria, true);
        return $categoria;


    }


    /**
     * @Rest\Delete (path="/{id}")
     *
     */
    public function deleteCategoria(Request $request){
        $categoriaId = $request->get('id');
        $categoria = $this->categoriaRepository->find($categoriaId);
        if(!$categoria){
           return new JsonResponse('No se ha encontrado', 400);
        }

        $this->categoriaRepository->remove($categoria, true);
        return new JsonResponse('Categoria borrada', 200);

    }

}