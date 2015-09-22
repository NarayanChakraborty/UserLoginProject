<?php
ini_set('mysql.connect_timeout',300);
ini_set('default_socket_timeout',300);
?>
<?php
 require_once('config.php');
if (isset($_POST['form1']))
{

  try{
     $u_fname=$_POST['fname'];
	 $u_lname=$_POST['lname'];
      $u_email=$_POST['email'];
	  $u_password=$_POST['password'];
	  $u_rpassword=$_POST['rpassword'];
	  $u_country=$_POST['country'];
	  $u_birthday=$_POST['birthday'];
	  $u_gendar=$_POST['gendar'];
	  
	  $valid=1;
	  $msg="";
	  
	  
	  /*
	    $target_dir="uploads/";
		$target_file=$target_dir.basename($_FILES['image']['name']);
		$uploadOk=1;
		$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
		$check=getimagesize($_FILES['image']['tmp_name']);
		if($check!==false)
		{
		   echo "File is an image- ".$check['mime'].".";
		   $uploadOk=1;
		   }
		   else{
		   echo "File is not an image";
		   $uploadOk=0;
		 }
		 //check if file already exists
		 if(file_exists($target_file)){
		 echo "Sorry,file already exists";
		 $uploadOk=0;
		 }
		 //check file size
		 if($_FILES['image']['size']>1000000){
		 echo "Sorry,your file is too large";
		 $uploadOk=0;
		 }
		 //Allow certain file formats
		 if($imageFileType!="jpg"&&$imageFileType!="png"&&$imageFileType!="jpg"&&$imageFileType!="jpeg"&&$imageFileType!="gif")
*/
		if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
		 {
		   throw new Exception("<div class='error'>Please select an image</div>");
		 }
		 if($_FILES['image']['size']>1000000){
		 throw new Exception("<div class='error'>Sorry,your file is too large</div>");
		 }
		 $image_name=addslashes($_FILES['image']['name']);
		 $imageFileType=pathinfo($image_name,PATHINFO_EXTENSION);
		 
		 if($imageFileType!="jpg"&&$imageFileType!="png"&&$imageFileType!="jpeg"&&$imageFileType!="gif")
		 throw new Exception("<div class='error'>File Type must be jpg/png/jpeg/gif</div>");
		 
		 $image=addslashes($_FILES['image']['tmp_name']);
		 $image=file_get_contents($image);
		 $image=base64_encode($image);
		if(empty($u_fname))
		{
		  $valid=0;
		  $msg.="First name can not be empty<br>";
		   //throw new Exception("first name can not be empty");
		   //echo "<div class='error'>First name can not be empty</div><br>";
		}
		if(empty($u_lname))
		{
		   $valid=0;
		   $msg.="Last name can not be empty<br>";
		   //throw new Exception("Last name can not be empty");
		   //echo "<div class='error'>Last name can not be empty</div><br>";
		}
		if(empty($u_email))
		{
		   $valid=0;
		   $msg.="Email name can not be empty<br>";
		   //throw new Exception("Email name can not be empty");
		   //echo "<div class='error'>Email name can not be empty</div><br>";
		}
		if(empty($u_password))
		{
		   $valid=0;
		   $msg.="Password name can not be empty<br>";
		   //throw new Exception("Password name can not be empty");
		   //echo "<div class='error'>Password name can not be empty</div><br>";
		}
		if(empty($u_rpassword))
		{
		   $valid=0;
		   $msg.="Password name can not be empty<br>";
		   //throw new Exception("Password name can not be empty");
		   //echo "<div class='error'>Password name can not be empty</div><br>";
		}
		if(empty($u_country))
		{
		   $valid=0;
		   $msg.="Country name can not be empty<br>";
		   //throw new Exception("Country name can not be empty");
		   //echo "<div class='error'>Country name can not be empty</div><br>";
		}
		if(empty($u_birthday))
		{
		   $valid=0;
		   $msg.="Birthday date can not be empty<br>";
		   //throw new Exception("Birthday date can not be empty");
		   //echo "<div class='error'>Birthday date can not be empty</div><br>";
		}	
		if(empty($u_gendar))
		{
		   $valid=0;
		   $msg.="gender can not be empty<br>";
		   //throw new Exception("gender can not be empty");
		   //echo "<div class='error'>gender can not be empty</div><br>";
		}
		if(!(preg_match("/^[a-z0-9_-]{6,40}$/i", $u_password)))
		{
		 /* $valid=0;
		  $msg.="Your Passord length must be atleast of 6 characters<br>";*/
		  throw new Exception("<div class='error'>Your Passord length must be atleast of 6 characters<br></div>");
		}
		if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $u_email)))
		{
		  $valid=0;
		  $msg.="Please Enter a valid Email Address<br>";
		  //echo "<div class='error'>Please Enter a valid Email Address</div><br>";
		}
		if(!(preg_match("/^[A-Za-z][A-Za-z]{2,21}$/",$u_fname)))
		{ 
		  $valid=0;
		  $msg.="Please Enter a valid First Name(length between 3 and 22)<br>";
		  //echo "<div class='error'>Please Enter a valid First Name(length between 3 and 22)</div><br>";
		}
			if(!(preg_match("/^[A-Za-z][A-Za-z]{2,21}$/",$u_lname)))
		{ 
		  $valid=0;
		  $msg.="Please Enter a valid Last Name(length between 3 and 22)<br>";
		 // echo "<div class='error'>Please Enter a valid Last Name(length between 3 and 22)</div><br>";
		}
	    if(!isset($_POST['agree']))
		{
		  throw new Exception("<div class='error'>You Must Agree with the term and policies</div>");
		}
	
		if($valid!=1)
		{
		   echo "<div class='error'>".$msg."</div><br>";
		 }
		 else{
		  if($_POST['password']!=$_POST['rpassword'])
		   {	
					 throw new Exception("<div class='error'>Password doesnot match</div><br>");
			}
		  $password=md5($_POST['password']);
		  $result1=mysql_query("insert into user_personal(first_name,last_name,user_email,user_password,country,birthday,gendar,image_name,image) values('$_POST[fname]',
		  '$_POST[lname]','$_POST[email]','$password','$_POST[country]','$_POST[birthday]','$_POST[gendar]','$image_name','$image')");
		  $success_msg="<div class='success'>Data has been successfully inserted</div><br>";
		}
		
	}
	catch(Exception $e)
	{
      $error_msg=$e->getMessage();   
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
<body>
<div class="form1">
<h3>SIGN UP FOR A FREE ACCOUNT</h3>  
<img src="fb.png" alt=""><br>
<hr>
<h4>Enter your information below.All rights are reserved</h4>
<?php 
if(isset($error_msg))
{
echo $error_msg;
}
if(isset($success_msg))
{
echo $success_msg;
}
?>
<form action=" " method="POST" enctype="multipart/form-data">
<Table>
	<tr>
		<td>First Name:</td>
		<td><input type="text"name="fname"></td>
	</tr>
	<tr>
		<td>Last Name:</td>
		<td><input type="text"name="lname"></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="text"name="email"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password"name="password"></td>
	</tr>
	<tr>
		<td>Retype Password</td>
		<td><input type="password"name="rpassword"></td>
	</tr>
	<tr>
		<td>Country</td>
		<td><input type="text"name="country"></td>
	</tr>
	<tr>
		<td>Birthday</td>
		<td><input type="text"name="birthday"></td>
	</tr>
	<tr>
		<td>Gender</td>
		<td>
			     <select  name="gendar" size="1">
				    <option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="None">None</option>
				 </select>	   
		</td>
	</tr>
		<tr>
	    <td>Upload Your Image</td>
		<td><input type="file" name="image"></td>
	</tr>
	<tr>
	<td></td>
	<td><input style="margin:2px 10px 3px;" type="Checkbox"name="agree"value="1"> I agree with all the<br>
	<span style="color:#df4135;">&nbsp;&nbsp;Terms</span> and <span style="color:#df4135;">Policies</span></td>
	</tr>
    <tr>
	<td><br><a style="color:#fff;" href="index.php">Back</a></td>
	<td><br><input style="font-size:15px;" type="submit" name="form1" value="SIGN UP"></td>
	</tr>
</Table><br>
</form>
</div>
</body>
</html>