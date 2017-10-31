<?php

include('categories.php');

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $query = $db->prepare('SELECT * FROM question WHERE id =:id');
  $query->execute(array(
':id' => intval($id)

  ));
  $question = $query->fetch(PDO::FETCH_OBJ); //renvoie un objet
}


 ?>
 <form method="POST" style="width:30%;">
   <div class="form-group">
     <label for="">Intitulé</label>
     <input value="<?=$question->title?>" type="text" class="form-control" name="title"  required >
   </div>

   <div class="form-group">
     <select name="category">
       <option value="0">Choisir une catégorie</option>
       <?php foreach($categories as $category): ?>
         <?php if($question->category == $category): ?>
           <option selected><? category ?></option>
         <?php else:  ?>


         <?php endif ?>
     <?php endforeach ?>
     </select>

   </div>

   <div class="form-group">
     <select name="level">
       <option value="0">Choisir un niveau de difficulté</option>
       <?php foreach($categories as $category): ?>
       <option><?= $category ?></option>
     <?php endforeach ?>

     </select>

   </div>
 <input type="submit" class="btn btn-primary" value="Modifier"  name="submit">
 </form>
