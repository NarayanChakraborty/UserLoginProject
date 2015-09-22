<?php
require_once('config.php');
if(isset($_POST["form2"]))
{
   $u_email=$_POST['email'];
   try{
		   if(empty($u_email)||empty($_POST['password']))
		   {
			 throw new Exception("No field can't be empty<br>");
			 }
			 if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $u_email)))
		    {
			 throw new Exception("Please Enter a valid Email Address<br>");
			  //echo "<div class='error'>Please Enter a valid Email Address</div><br>";
		    }
			$password=md5($_POST['password']);
			$num=0;
			$result=mysql_query("Select user_id from user_personal where user_email='$_POST[email]' and user_password='$password'");
			
			$num=mysql_num_rows($result);
            if($num>0)
            {
                session_start();
				$value=mysql_result($result,0,'user_id');
				$_SESSION['name']=$value;
				header('location: Home.php');
             }
            else
            {
               throw new Exception("Invalid Username/password");
               header('location: signin.php');			   
             }			   
		 }
	catch(Exception $e)
     {
     echo ($e->getMessage());
	 }  
}

?>

<!doctype html>
<html lang="en">
<head>
     <meta charset="UTF-8">
	 <title>login-simple Blog with PHP</title>
	 <link rel="stylesheet" href="project.css">
</head>
<body >
<div id="signin">
        <h1>User Login</h1>
      <form action="" method="post">
       <table>
            <tr>
                 <td>Email:</td>
                 <td><input type="text" name="email"></td>
            </tr>
            <tr>
                  <td>Password:</td>
                   <td><input type="password" name="password"></td>
             </tr>
			 <tr>
                  <td><br><a style="color:#fff;" href="index.php">Back</a></td>
                   <td><br><input type="submit" value="Signin" name="form2"></td>
             </tr>
        </table>
      </form>
	  
	  </div>
</body>
</html>	  