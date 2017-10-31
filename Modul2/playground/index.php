<?php
$db = new PDO('mysql:host=localhost;dbname=quizz', 'root' , 'paris');
// $db est un objet de type PDO, il contient des  proopriétés et
// des méthodes permettant d'interagir avec la BD
//var_dump($db);

// -> query();
$sql = 'SELECT * FROM stagiaire';
// $db -> query($sql);
//fetch
foreach($db->query($sql, PDO::FETCH_OBJ) as $s){
  // var_dump($s);
  // echo '<p>'.$s['nom'].' '.$s['prenom'].'</p>';
  // echo '<p>'.$s{1}.'</p>'
  // echo 'ok';
  echo '<p>OBJ'. $s->prenom   .'</p>';
}
?>
