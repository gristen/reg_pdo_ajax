<?php
session_start();
require_once 'db.php';


$email = trim(htmlspecialchars($_POST["email"]));
$password = trim(htmlspecialchars ($_POST["password"]));
$password_confirmation = trim(htmlspecialchars($_POST["password_confirmation"]));




 $len = strlen($password);

 

$errors = array();

 $user = $dbh->prepare("SELECT * FROM `users`  WHERE `email` = :email ");
 $user->execute([
    "email"=>$email,
 ]);





 if ($email == "" || $password == "" || $password_confirmation == "") {
 	$errors[] = 'Пустые поля!';

 }elseif($password !== $password_confirmation){
	$errors[] = 'Пароли не совпадают!';
 }elseif($len <=3){
 	$errors[] = 'короткий пароль!';
 }elseif($count=$user->rowCount() > 0 ){
 	$errors[] = 'Пользователь с таким емайлом уже зарегестрирован!';
 }

 if (empty($errors)){
	$answer = ['type' => 'success', 'message' => $success];

 }else{
 	$answer = ['type' => 'error', 'message' => $errors];
 	 echo json_encode($answer);
 	exit();
}
   echo json_encode($answer); // отправляем массив в json формате , чтобы ajax его мог понять






$store_user = $dbh->prepare("INSERT INTO `users` (`email`,  `password`) VALUES (:email, :password)"); //
$store_user->execute([
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT),

]);



$_SESSION['user_id'] = $dbh->lastInsertId();














?>
