<?php

 namespace AppBundle\Controller;

 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\HttpFoundation\Response;
 use AppBundle\Classes\Fruit;

class TestController extends Controller {

   private $message = "Petit message";
   private $fruits = ['pêche', 'pomme', 'poire', 'abricot'];
   private $fruits2 = array(
     array('name' => 'Mangue', 'origin' => 'Amérique du Sud', 'comestible' => true),
     array('name' => 'Banane', 'origin' => 'Guadeloupe', 'comestible' => true),
     array('name' => 'Ananaze', 'origin' => 'Tchernobyl', 'comestible' => false),
   );
   //ERREUR, on ne peut pas instancier la class Fruit
   // à cet endroit. Il faut se placer dans le contructeur
   // de TestController pour réussir cette instanciation
  //  private $fruits3 = array(
  //    new Fruit ('Orange', 'Sicile', true),
  //    new Fruit ('Tromate', 'Suceava', false),
  //    new Fruit ('Limone', 'Bari', true),
  //  );
    private $fruits3; // déclaration sans assignation
    // l'assignation se fera "sereinement" dans le constructeur

     public function __construct(){
       $this->fruits3= array(
       new Fruit ('Orange', 'Sicile', true , 'https://en.wikipedia.org/wiki/Orange_S.A.'),
       new Fruit ('Tromate', 'Suceava', false, ''),
       new Fruit ('Limone', 'Bari', true, 'https://en.wikipedia.org/wiki/Citron'),
     );}


   public function getMessage(){
     return $this->message;
   }

   private function getFruitList(){
     $output = "<ul>";
     foreach($this->fruits as $fruit){
       $output .= "<li>". $fruit ."</li>";
      // 'fruits2' => $this->fruits2,
     }
     $output .= "</ul>";
     return $output;
   }



   /**
   *  @Route("/example")
   */

   public function exampleAction(){


    //  $res1 = new Response('toto');
    //  $res2 = new Response('<h1>toto</h1>');
    //  $res3 = new Response($this->getMessage());





      return $this->render('test/example.html.twig' , array(
        'fruits' => $this->fruits3,
      ));
   }






   /**
   *  @Route("/fruits/list")
   */

   public function fruitsListAction(){

       return new Response($this->getFruitList());
}




    /**
    *  @Route("/fruits/static")
    */

    public function  fruitsStaticAction(){

    // renvoie ficher html statique

    return $this->render('test/fruits.html');
  }





/**
*  @Route("/fruits")
*/

public function  fruitsAction(){

// renvoie ficher dinamique TWIG
// le deuxième argument de la méthod .rendre
// est un tableau associatif permettant de fournir'fruits2' => $this->fruits2,
// à la vue des données aussi bien simples (chines, entiers, etc.)
// que complexes (tableau, objets)

return $this->render('test/fruits.html.twig', array(
  'title' => 'List de fruits',
  'message' => $this->getMessage(),
  'fruits' => $this->fruits,
  'fruits2' => $this->fruits2,
  'fruits3' => $this->fruits3,
  'toto' => NULL,

));
}

}
