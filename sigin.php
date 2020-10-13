<?php
include 'C:\wamp64\www\test\library\latp.php';

if (isset($_GET['username']) and isset($_GET['passwords']) ) {

if (do_login($_GET['username'],$_GET['passwords'])) {
   # code...
   header("Location:http://localhost/Test/album/home.php");
 } 
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signup.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" method="GET">
  <img class="mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Sigin-In</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="text" class="form-control" placeholder="User Name" name="username" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" name="passwords" placeholder="Password" required>
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign-In</button><br>
  <a href="http://localhost/test/signup/signup.php">or Create New</a>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
</body>
</html>
