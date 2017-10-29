<?php




function listeStagiaires(){
  $stagiaires = array(
  array('nom' => 'abecassis', 'prenom' => 'stéphane', 'totem' => 'an1.jpg', 'notes' => array(8,12,18) , 'password' => 1111), //for the last one we can write also like this 'notes' =>[]
  array('nom' => 'chauvet', 'prenom' => 'stevens' ,'totem' => 'wolf.jpg', 'notes' => array(4,1,17), 'password' => 2222),
  array('nom' => 'grivel', 'prenom' => 'sébastien', 'totem' => 'dog.jpeg', 'notes' => array(9,22,14) , 'password' => 4444),
  array('nom' => 'jafari', 'prenom' => 'sajjad', 'totem' => 'wolf.jpg', 'notes' => array() , 'password' => 5555),
  array('nom' => 'langlais', 'prenom' => 'rémi', 'totem' => 'dog.jpeg', 'notes' => array(9,2,4) , 'password' => 6666),
  array('nom' => 'grivel', 'prenom' => 'abdel', 'totem' => 'an1.jpg', 'notes' => array(8,14,19) , 'password' => 7777),
  array('nom' => 'grivel', 'prenom' => 'léa', 'totem' => 'wolf.jpg', 'notes' => array(4,8,6) , 'password' => 8888),
  array('nom' => 'grivel', 'prenom' => 'amare', 'totem' => 'dog.jpeg', 'notes' => array() , 'password' => 3333),
  array('nom' => 'grivel', 'prenom' => 'nadia', 'totem' => 'an1.jpg', 'notes' => array(6,15,16) , 'password' => 9999),
  array('nom' => 'grivel', 'prenom' => 'françois', 'totem' => 'wolf.jpg', 'notes' => array() , 'password' => 1010),

  );

  return $stagiaires;
}

 ?>
