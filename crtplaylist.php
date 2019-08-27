<?php
$em =$_REQUEST['em'];
$val=$_REQUEST['nm'];
  try
  {
   $cmd = new PDO('mysql:host=localhost;dbname=accounts', 'root', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $stmt='alter table `'.$em.'` add '.$val.' int unique;';
   $que=$cmd->query($stmt);
  }
  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
?>
