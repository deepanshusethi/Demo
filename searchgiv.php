<?php

  $val = $_REQUEST['nhv'];
  $cnme= $_REQUEST['nhc'];
  $stmt='select title from song_list inner join song_info on song_info.sid=song_list.sid where '.$cnme.'=\''.$val.'\';';
  try
  {
   $cmd = new PDO('mysql:host=localhost;dbname=user_song_info', 'ext_user', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $que=$cmd->query($stmt);
   $i=0;
   $j=0;
   $hld=[];
   while($res=$que->fetch(PDO::FETCH_NUM))
    {
      $hld[]= $res[0];
    }
    echo json_encode($hld);
  }
  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
?>
