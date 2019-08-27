<?php
  $em =$_REQUEST['em'];
  $val=$_REQUEST['id'];
  $stmt='create table if not exists `'.$em.'` (favourites int unique);';
  try
  {
   $cmd = new PDO('mysql:host=localhost;dbname=accounts', 'root', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $que=$cmd->query($stmt);
   $cmd=null;
   $cmd = new PDO('mysql:host=localhost;dbname=user_song_info', 'ext_user', '');
   $stmt='select sid from song_list where title=\''.$val.'\';';
   $que=$cmd->query($stmt);
   $res=$que->fetch(PDO::FETCH_NUM);
   $cmd=null;
   $cmd = new PDO('mysql:host=localhost;dbname=accounts', 'root', '');
   $stmt='insert into `'.$em.'` (favourites) values ('.$res[0].');';
   $que=$cmd->query($stmt);
  }
  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
?>
