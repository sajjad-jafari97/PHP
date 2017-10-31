<?php
include('routes.php');
$db = new PDO('mysql:host=localhost;dbname=quizz', 'root' , 'paris');

if(isset($_GET['route'])){
  $route = $_GET['route'];
}


 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Module 2 : Quizz app</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

   </head>
   <body>
     <header>
       <nav>
         <ul class="nav nav-tabs">
           <li><a href="?route=question/list">List des questions</a></li>
           <li><a href="?route=question/add">Ajouter une questions</a></li>
         </ul>
       </nav>
     </header>

<h1>Module 2 : Quizz app</h1>

<?php
if(isset($route)){
  include($routes[$route]);
}

 ?>

</body>
</html>
