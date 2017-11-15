<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Fruit;

/**
* @Route("/fruits")
*/
class FruitController extends Controller {


  /**
  * @Route("/", name="fruit_admin_page")
  */
  public function indexAction(Request $request) {

    $post = $request->request;
    // echo $post->get('name'); //echo $_POST['name']
      //echo $request->request->get('origin');
    if($request->getMethod() == 'POST'){
      $name = $post->get('name');
      $origin = $post->get('origin');
      $comestible = $post->get('comestible');

      //vérification du contenu de la variable $comestible
      $comestible = ($comestible) ? 1 : 0 ; //it's like if and else, if it's true it's one and else it's 0


      $fruit = new Fruit();
      // hydratation
      $fruit->setName($name);
      $fruit->setOrigin($origin);
      $fruit->setComestible($comestible);


      // utilisation du EntityManager

      $em = $this->getDoctrine()->getManager();
      $em->persist($fruit); // prépare la réquête d'insertion
      // mais n'execute aucune requête sql


      $em->flush(); //éxecute toutes les reqûetes SQL en attenete

    }

    // récupération des fruits
    // Fruit::class retourne chemin + nom de la class
    // .get repository pour les opération de lecture
    $fruits = $this
     ->getDoctrine()
     ->getRepository(Fruit::class)
     ->findAll();

    return $this->render('fruit/index.html.twig', array(
          'fruits' => $fruits,
    ));
  }

  /**
  * @Route("/delete/{id}", name="fruit_delete")
  */
  public function deleteAction($id) {
    // l'argument $id correspond au paramètre {id}
    // défini au niveau de l'annotation @Route
    return new Response("Id du fruits à supprimer" . $id);
  }
}
