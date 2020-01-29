<?php
  require "header.php";
?>

    <main>
      <h1>Signup</h1>
      <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == "emptyfields"){
            echo '<p>Fill out all fields</p>';
          }
          else if($_GET['error'] == "invalidmail"){
            echo '<p>bad mail address</p>';
          }
        }
        else if($_GET['signup'] == "success"){
          echo '<p>signup successfull</p>';
        }
      ?>
      <form action="includes/signup.inc.php" method="post">
        <input type="text" name="uid" placeholder="username">
        <input type="text" name="mail" placeholder="e-mail">
        <input type="text" name="pwd" placeholder="password">
        <input type="text" name="pwd-repeat" placeholder="repeat password">
        <button type="submit" name="signup-submit">Signup</button>
      </form>
    </main>

<?php
  require "footer.php";
?>