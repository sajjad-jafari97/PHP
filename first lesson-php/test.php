<p>HEY GUYS</p>
<?php
// PHP est un langage à type dynamique
//TYPES SIMPLE

$v = "Bonjour"; //string
echo $v;
echo gettype($v);

$v = 14; //number
echo $v;
echo gettype($v);

$v = 14.7; //double
echo $v;
echo gettype($v);

$v = true; //  boolean
echo gettype($v);

$v2;
echo gettype($v2);

//opéraion sur integer
$nb1 = 45;
$nb2 = 2;
$nb3 = "3";
echo $nb1 * $nb3; // conversion implicite de $nb3 en integer
// =>135

$str1 = "Un teins vaut mieux";
$str2 = "Que deux tu l'auras";

echo "<h2>" . $str1 . " " . $str2 . "</h2>"; //concaténation


//TYPE COMPLEXES
// tableau à indice numérique (commence à 0)
$tableau = [];
$tableau2 = array();
echo gettype($tableau);
echo gettype($tableau2);


$etudiants = ["étudiant 1" , "étudiant 2" , "étudiant 3"];
echo $etudiants[2]; //étudiants 3

$etudiants[0] = "samir";
echo $etudiants[0];

$mix = ["chaine" , 45, false, NULL, $etudiants];
echo $mix[4][0];// tableau à deux dimensions


// tableau associatifs

$joueurs = array(
  'joueur1' => array(
    'nom' => 'Messi',
    'prenom' => 'Lionel',
    'maillot' => 10

  )

);
echo "<br>";
echo $joueurs['joueur1']['prenom'];
echo " "; //To make space
echo $joueurs['joueur1']['nom'];

$j1 = array('prenom' => 'Paolo', 'nom' => 'Dybala', 'maillot' => 10);
$j2 = array('prenom' => 'Giorgio', 'nom' => 'Chiellini', 'maillot' => 3);
$j3 = array('prenom' => 'Andrea', 'nom' => 'Barzagli', 'maillot' => 15);

$juve = array($j1, $j2, $j3);

// mis à jour du numéro de maillot du jouer Dybala
// deux solutions
$j1["maillot"] = 21;
$juve[0]['mailliot'] = 21;

echo $juve[0]['mailliot'];

// structure itératives
//boucle for
echo '<ul>';
for($i =0; $i<sizeof($juve); $i++){
echo '<li>'. $juve[$i]['prenom'] . " " . $juve[$i]['nom'] . '</li>';
}
echo '</ul>';

 ?>
