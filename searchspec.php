<?php

  $val = $_REQUEST['v'];
  $stmt='select sid from song_list where title=\''.$val.'\';';
  try
  {
   $cmd = new PDO('mysql:host=localhost;dbname=user_song_info', 'ext_user', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $que=$cmd->query($stmt);
   $hld=[""];
   while($res=$que->fetch(PDO::FETCH_ASSOC))
    {
        $hld[]=$res["sid"];
    }
    echo json_encode($hld);
  }
  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
?>
