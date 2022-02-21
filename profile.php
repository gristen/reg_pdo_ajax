<?php
session_start();
$title = 'Профиль';
require ('head.php');




?>



<body>
    <h1>рег</h1>
<span>
	<?php 

	

if (isset($_SESSION['user']['id'])){
 	print_r($_SESSION['user']['id']);
 	unset($_SESSION['user']['id']);
 	
 }else{
 	print_r($_SESSION['user_id'] );
 
 }



 ?>
 	
 </span>

<nav class="nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link text-danger border border-danger" href="/vendor/logaut.php">Выход</a>
  </nav>
 


</body>
