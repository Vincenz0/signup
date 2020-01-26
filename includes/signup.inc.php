<?php
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  // empty field
  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email."1");
    exit();
  }
    
  //valid mail & username
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../signup.php?error=invalidmailuid");
    exit();
  }
 
  //valid mail
          
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../signup.php?error=invalidmail&uid=".$username."3");
    exit();
  }
 
  //username 
  else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../signup.php?error=invaliduid&mail=".$email."4");
    exit();
  }
  //repeated password is equal or not?
  else if($password !== $passwordRepeat){
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email."5");
    exit();
  }
  //matching user already in our database
  else {
    //ne tehessek tonkre az adatbazist kb. 52.perctol https://www.youtube.com/watch?v=LC9GaXkdxF8&t=400s
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
    // statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: ../signup.php?error=sqlerror6");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0){
        header("Location: ../signup.php?error=usertaken&mail=".$email."7");
        exit();
      }
      else {
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES(?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
          header("Location: ../signup.php?error=sqlerror8");
          exit();
        }
        else {
          // sifralja a jelszavat hashing password
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);
          header("Location: ../signup.php?signup=success9");
          exit();
        }

      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}
else {
  header("Location: ../signup.php10");
  exit();
}