<?php
include('lib/function.php');
include('datasource.php');

$stagiaires = listeStagiaires();



$title = "Liste des stagiaires";

 ?>


<?php
  include('header.php')
 ?>
    <h1><?php echo $title ?></h1>
    <table class=" table-bordered col-md-7">
      <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Totem</th>
        <th>Derniere Note</th>
        <th>Moyenne de notes</th>

      </tr>

      <?php

      foreach($stagiaires as $s){
        $moyenne = moyenne($s['notes'], 2);

        echo '<tr>';
        echo '<td>'.'<a href="stagiaire_details.php?nom='.$s['prenom'].'">'. majusculeIntiale($s['prenom']).'</a>' .'</td>';
        echo '<td>'. majusculeIntiale($s['nom']).'</td>';
        echo '<td><img src="img/'.$s['totem'] .'"> </td>';
        // echo '<td>' . $s['notes'][2] . '</td>';
        echo '<td>'. derniereNote($s['notes']) .'</td>';

        if($moyenne < 10 && $moyenne != AUCUNE_NOTE_MSG){
          echo '<td style="color:red">'. moyenne($s['notes'], 2) .'</td>';

        }else{
          echo '<td>'. moyenne($s['notes'], 2) .'</td>';
        }


        echo '</tr>';
      }


       ?>

    </table>


    <aside class="col-md-5" style="background:red; height:auto">
      <div class="" style="background:yellow; height:500px; margin:auto">

      </div>
    </aside>

<?php
  include('footer.php')
 ?>
