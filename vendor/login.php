<?php
session_start();
require_once 'db.php';


 $email = trim(htmlspecialchars($_POST["email"]));
$password = trim(htmlspecialchars ($_POST["password"]));





$errors = array();


$user = $dbh->prepare("SELECT * FROM `users`  WHERE `email` = :email ");
 $user->execute([
    "email"=>$email,
    // "password"=>$password

 ]);
if ($count=$user->rowCount() > 0  ) {
    $userVal = $user->fetch();

    if (password_verify($password, $userVal['password']) == true ) {
      $_SESSION['user'] = [
        "id"=> $userVal['id'],
        "email"=> $userVal['email']

      ];
    }


  
}else{
$errors[] = 'Такой пользователь не зарегестрирован ';
}


 if (empty($errors)){
    $answer = ['type' => 'success', 'message' => $success];

 }else{
    $answer = ['type' => 'error', 'message' => $errors];
     echo json_encode($answer);
    exit();
}
   echo json_encode($answer); // отправляем массив в json формате , чтобы ajax его мог понять








































?>
