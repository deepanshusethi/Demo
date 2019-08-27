<?php
$em =$_REQUEST['em'];
$val=$_REQUEST['id'];
$stmt='select '.$val.' from `'.$em.'` ;';
  try
  {
   $cmd = new PDO('mysql:host=localhost;dbname=accounts', 'ext_user', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $que=$cmd->query($stmt);
   $hld=[];
   while($res=$que->fetch(PDO::FETCH_NUM))
   {
     if($res[0]==null)
     {continue;}
   $hld[]=$res[0];
   }
   $cmd=null;
   $cmd = new PDO('mysql:host=localhost;dbname=user_song_info', 'ext_user', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $i=0;
    while($i<count($hld))
    {
     $stmt='select title from song_list where sid='.$hld[$i].';';
     $que=$cmd->query($stmt);
     $res=$que->fetch(PDO::FETCH_NUM);
     $hld[$i]=$res[0];
     $i++;
    }
    echo json_encode($hld);
   }

  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
?>
