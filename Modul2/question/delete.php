<?php
// suppresion de la question dont l'id est passé en paramètre d'url
if(isset($_GET['id'])){
$id = $_GET['id'];

$query = $db->prepare('DELETE FROM question WHERE id = :id');
$result = $query->execute(array(
  ':id' => intval($id)
));

if($result) {
// en cas de succés, redirection vers la list des questions;
header('location:?route=question/list');

}else{

  echo '<p>Suppression impossible</p>';
}

}
 ?>
