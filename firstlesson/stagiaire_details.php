<?php
include('lib/function.php');
include('datasource.php');
include('header.php');

// print_r($_GET);
if(isset($_GET['id'])){

$id = $_GET['id'];
$stagiaire = stagiaireParId($id);
}
if($stagiaire){
  echo afficheStagiaireDetails($stagiaire);

}else {
   echo 'Student was not found ';

}
else {
  echo 'Paramètre id manquant';
}

?>
<!-- les codes ici -->





<?php
include('footer.php');

?>
