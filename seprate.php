<?php

  $val = $_REQUEST['iv'];
  $cnme= $_REQUEST['ph'];
  $stmt='select distinct artist,album,genre,age,language from song_info where '.$cnme.'=\''.$val.'\';';
  try
  {
   $cmd = new PDO('mysql:host=localhost;dbname=user_song_info', 'ext_user', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $que=$cmd->query($stmt);
   $i=0;
   $j=0;
   $hld;
   while($res=$que->fetch(PDO::FETCH_NUM))
    {
        $hld[$i][]=$res[0];
        $hld[$i][]=$res[1];
        $hld[$i][]=$res[2];
        $hld[$i][]=$res[3];
        $hld[$i][]=$res[4];
        $i++;
    }
    echo json_encode($hld);
  }
  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
?>
