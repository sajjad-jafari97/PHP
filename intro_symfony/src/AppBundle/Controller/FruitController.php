<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Fruit;
use AppBundle\Entity\Producer;
use AppBundle\Entity\Category;

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
      // on récupére un tableau d'identifiants de categorie
      // exemple: ["1" , "4"]correspondants aux cases cochées
      $categories_posted = $post->get('categories');
      var_dump($categories_posted);

      // récupére l'objet producer complet à partir d'un id
      $producer = $this->getDoctrine()->getRepository(Producer::class)->find($producer_id);




      //vérification du contenu de la variable $comestible
      $comestible = ($comestible) ? 1 : 0 ; //it's like if and else, if it's true it's one and else it's 0

      $fruit = new Fruit();
      if($categories_posted !== NULL){
        // l'utilisateur a coché au moins une case de catégorie


      // boucle sur le tableau de identifiants des catégories cocbées
      foreach ($categories_posted as $c) {
        // A chaque passage création d'un objet de type Category
        $category = $this ->getDoctrine()->getRepository(Category::class)->find($c);
        // Alimentation de la propriété category de l'objet $fruit
        $fruit->addCategory($category);

      }
    }

      // hydratation
      $fruit->setName($name);
      $fruit->setOrigin($origin);
      $fruit->setComestible($comestible);
      $fruit->setProducer($producer);


      // utilisation du EntityManager

      $em = $this->getDoctrine()->getManager();
      $em->persist($fruit); // prépare la ré    return new Response("Id du fruits à supprimer" . $id);équête d'insertion
      // mais n'execute aucune requête sql

      $em->flush(); //execute toutes les reqûetes SQL en attente

    }

    // Récupération des fruits
    // Fruit::class retourne chemin + nom de la class
    // .get repository pour les opération de lecture
    $fruits = $this
     ->getDoctrine()
     ->getRepository(Fruit::class)
     ->findAll();

     // Récupération des producteurs
     $producers = $this
      ->getDoctrine()
      ->getRepository(Producer::class)
      ->findAllNotAssigned();
      // récupération des category
      $categories = $this
       ->getDoctrine()
       ->getRepository(Category::class)
       ->findAll();

    return $this->render('fruit/index.html.twig', array(
          'fruits' => $fruits,
          'producers' => $producers,
          'categories' => $categories,

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

  /**
  * @Route("/{id}", name="fruit_details")
  */

  public function detailsAction($id){
    // récupérer un objet fruit à partir de l'indetifiant $id
    $fruit = $this->getDoctrine()
    ->getRepository(Fruit::class)
    ->find($id);

      return $this->render('fruit/details.html.twig', array(
        'fruit' => $fruit
      ));
  }

  /**
  * @Route("/category/{name}")
  */

  public function nameAction($name){
    $fruit = $this->getDoctrine()
    ->getRepository(Fruit::class)
    ->findByCategoryName($name);

      return $this->render('fruit/category_name.html.twig', array(
        'fruit' => $fruit,
        'name' => $name
      ));

  }

  /**
  * @Route("/api/json")
  */
  // conversiion du tableau PHP en chaine de caractères JSON
  public function jsonAction(){
    $fruit = ['pomme', 'poire', 'cerise'];
    $fruit_json = json_encode($fruit);
    return new Response($fruit_json);
  }

}
