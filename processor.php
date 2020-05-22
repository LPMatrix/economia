<?php 

require('dbconnect.php');
$db = DB();
require 'lib/library.php';
$app = new DemoLib();

	    if (isset($_POST['post'])) {
       $body = $_POST['body'];
       $user_id = $_POST['user'];
       $pst = $_POST['article'];

       //print_r($_POST);die();

       $stmt7 = $app->runQuery("INSERT INTO comments(article,user,body) VALUES(:article, :user, :body)");
       $stmt7->bindParam("article",$pst);
       $stmt7->bindParam("user",$user_id);
       $stmt7->bindParam("body",$body);
       $stmt7->execute();

       header("location:single.php?pst=$pst");
    }
 ?>