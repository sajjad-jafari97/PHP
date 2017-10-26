<?php




function listeStagiaires(){
  $stagiaires = array(
  array('nom' => 'abecassis', 'prenom' => 'stéphane', 'totem' => 'an1.jpg', 'notes' => array(8,12,18)), //for the last one we can write also like this 'notes' =>[]
  array('nom' => 'chauvet', 'prenom' => 'stevens' ,'totem' => 'wolf.jpg', 'notes' => array(4,1,17)),
  array('nom' => 'grivel', 'prenom' => 'sébastien', 'totem' => 'dog.jpeg', 'notes' => array(9,22,14)),
  array('nom' => 'jafari', 'prenom' => 'sajjad', 'totem' => 'wolf.jpg', 'notes' => array()),

  );

  return $stagiaires;
}

 ?>
