<html>
<body>
<?php 
 include_once("DBConnection.php"); 
 session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{ 
    if (empty($_POST['username']) || empty($_POST['password']))
    { 
        echo 
        "Incorrect username or password"; //
        header("location: LoginForm.php");
    } 
 
     $inUsername = $_POST["username"]; 
     $inPassword = $_POST["password"]; 
     $stmt= $db->prepare("SELECT USERNAME, PASSWORD FROM PROFILE WHERE USERNAME = ?"); 
     $stmt->bind_param("s", $inUsername); 
     $stmt->execute();
     $stmt->bind_result($UsernameDB, $PasswordDB); 
      
    
     if ($stmt->fetch() && password_verify($inPassword, $PasswordDB)) 
     {
        $_SESSION['username']=$inUsername; 
        header("location: UserProfile.php"); 
     }
     else
     {
           echo "Incorrect username or password"; 
          ?>         
          <a href="LoginForm.php">Login</a>
       <?php 
     } 
} 
       ?>
</body> 
</html>