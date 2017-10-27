<?php include('header.php');
 ?>
<h2>Contact</h2>

<form style="width:50%" action="form.php" method="post">
  <div class="form-group">
    <label for="">Objet</label>
    <input type="text" class="form-control" name="objet">
  </div>
  <div class="form-group">
    <label for="">Message</label>

    <textarea class="form-control" name="message"></textarea>
  </div>
  <input type="submit" name="" value="Valider">
</form>



 <?php include('footer.php');
  ?>
