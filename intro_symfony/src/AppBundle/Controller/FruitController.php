<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Fruit;
use AppBundle\Entity\Producer;

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
      $producer_id = $post->get('producer_id');

      // récupére l'objet producer complet à partir d'un id
      $producer = $this->getDoctrine()->getRepository(Producer::class)->find($producer_id);


      //vérification du contenu de la variable $comestible
      $comestible = ($comestible) ? 1 : 0 ; //it's like if and else, if it's true it's one and else it's 0


      $fruit = new Fruit();
      // hydratation
      $fruit->setName($name);
      $fruit->setOrigin($origin);
      $fruit->setComestible($comestible);
      $fruit->setProducer($producer);


      // utilisation du EntityManager

      $em = $this->getDoctrine()->getManager();
      $em->persist($fruit); // prépare la ré    return new Response("Id du fruits à supprimer" . $id);équête d'insertion
      // mais n'execute aucune requête sql


      $em->flush(); //éxecute toutes les reqûetes SQL en attente

    }

    // récupération des fruits
    // Fruit::class retourne chemin + nom de la class
    // .get repository pour les opération de lecture
    $fruits = $this
     ->getDoctrine()
     ->getRepository(Fruit::class)
     ->findAll();

     // récupération des producers
     $producers = $this
      ->getDoctrine()
      ->getRepository(Producer::class)
      ->findAll();

    return $this->render('fruit/index.html.twig', array(
          'fruits' => $fruits,
          'producers' => $producers,
    ));
  }

  /**
  * @Route("/delete/{id}", name="fruit_delete")
  */
  public function deleteAction($id) {
    // l'argument $id correspond au paramètre {id}
    // défini au niveau de l'annotation @Route
    $fruit = $this->getDoctrine()->getRepository(Fruit::class)->find($id);
    $em = $this->getDoctrine()->getManager();
    $em->remove($fruit); // requête de suppression en attente
    $em->flush(); //éxecute toutes les reqûetes SQL en attente
    return $this->redirectToRoute('fruit_admin_page');


  }


  /**
  * @Route("/update/{id}", name="fruit_update")
  */
  public function updateAction($id, Request $request ){
    //dans cette variante, l'objet fruit est crée sans le notifier
    // au manager

    // $fruits = $this
    //  ->getDoctrine()
    //  ->getRepository(Fruit::class)
    //  ->find($id);

    // Appeler getRepositorydepuis getManager établit une connexion
    // une 'visibilité' entre le repo et le manager
    // ici, le manager "est au courant", est notifié de l'existence de l'objet
    // fruit, si cet objet change (reçoit de nouvelles valeurs)
    // le manager le sait? Le manager "surveille" cet objet.
    $em = $this->getDoctrine()->getManager();

    $fruit = $em->getRepository(Fruit::class)->find($id);

     if($request->getMethod() == 'POST'){

       $fruit->setName($request->request->get('name'));
       $fruit->setOrigin($request->request->get('origin'));

       $comestible = ($request->request->get('comestible')) ? 1 : 0;
       $fruit->setComestible($comestible);


       $em->flush();
       return $this->redirectToRoute('fruit_admin_page');
     }


     return $this->render('fruit/update.html.twig', array(
           'fruit' => $fruit,
     ));
  }
}
