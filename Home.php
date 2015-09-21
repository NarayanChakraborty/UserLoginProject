<?php
 ob_start();
 session_start();
 if(isset($_SESSION['name'])&&!empty($_SESSION['name']))
 {
 echo "Your are logged in";
 }
 else
  header('location:signin.php');
  require_once('config.php');
  $id=$_SESSION['name'];
  $result=mysql_query("select * from user_personal where user_id='$id'");
 while($row=mysql_fetch_assoc($result))
  {
    $u_fname=$row['first_name'];
	$u_lname=$row['last_name'];
	$u_email=$row['user_email'];
	$u_country=$row['country'];
	$u_birthday=$row['birthday'];
	$u_gendar=$row['gendar'];
	$u_image=$row['image'];
	//header("Content-type: image");
	//echo $u_image;
  }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>Hey Welcome To Your Home Page</h1>
<table>
	<tr>
		
		<td>
        <?php 
		echo "<img height='300' width=300px' src='data:image;base64,".$u_image."'>"
		?>
		</td>
	</tr>
	<tr>
		<td>Name:</td>
		<td><?php echo $u_fname." ".$u_lname?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><?php echo $u_email?></td>
	</tr>
	<tr>
		<td>Country:</td>
		<td><?php echo $u_country?></td>
	</tr>
	<tr>
		<td>Birthday:</td>
		<td><?php echo $u_birthday?></td>
	</tr>
	<tr>
		<td>Gendar:</td>
		<td><?php echo $u_gendar?></td>
	</tr>
</table>
<a href="signout.php">LOG OUT</a>
</body>
</html>