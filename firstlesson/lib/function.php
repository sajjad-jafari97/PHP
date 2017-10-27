<?php
define('AUCUNE_NOTE_MSG', 'Aucune note');

function majusculeIntiale($str){
// dand cette version actuelle, les caractères accentués
//ne sont pas convertis en majuscule

  $initiale = $str[0];
  $reste = substr($str, 1);
  $initialeMajus = strtoupper($initiale);
  $resteMinus = strtolower($reste);// This one is for even if someone is gonna write a letter
  //on majuscule in middle of the word is gonna make them on minuscule
  return $initialeMajus . $resteMinus;
}

function derniereNote($notes){
//renvoie la dernière note si le tableau $notes n'est pas vide
//renvoie "aucun note" si le tableau $notes est vide

$nb_notes = sizeof($notes);

if ($nb_notes == 0){
  return AUCUNE_NOTE_MSG;
}else{

    return $notes[$nb_notes - 1];

}

}





function moyenne($notes, $precision){
  $nb_notes = sizeof($notes);


  if ($nb_notes == 0) return AUCUNE_NOTE_MSG;

  if($nb_notes == 1) return $notes[0];



  $somme = 0;
  foreach($notes as $note){
    $somme += $note; //équivalent à $somme = $somme + $note

  }
    return round($somme / $nb_notes, $precision);
  // else
  //
  //     return $notes[$nb_notes2 - 2];

  }


function afficheStagiaireDetails(){
$output = '';
$output .='<div class="stagiaire">';
$output .='<h2>'. $stagiaire['nom'].'</h2>';
$output .= '<img src="'.ASSETS_PATH.'img/' .$stagiaire['totem'].' " alt=""/>';
$output .='<div>';

return $output;


}



 ?>
