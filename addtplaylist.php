<?php
  $em =$_REQUEST['em'];
  $val=$_REQUEST['id'];
  $cnm=$_REQUEST['cnm'];
 try
  {
   $cmd = new PDO('mysql:host=localhost;dbname=user_song_info', 'ext_user', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $stmt='select sid from song_list where title=\''.$val.'\';';
   $que=$cmd->query($stmt);
   $res=$que->fetch(PDO::FETCH_NUM);
   $sid=$res[0];
   $cmd=null;
   $f=0;
   $cmd = new PDO('mysql:host=localhost;dbname=accounts', 'root', '');
   $stmt='select sno,'.$cnm.' from `'.$em.'`;';
   $que=$cmd->query($stmt);
    while($res=$que->fetch(PDO::FETCH_ASSOC))
    {
     if($res[$cnm]==null)
     {
       $stmt='update `'.$em.'` set '.$cnm.'='.$sid.' where sno='.$res['sno'].';';
       $que=$cmd->query($stmt);
       $f=1;
       echo "Added to ".$cnm;
       break;
     }
    }
    if($f==0)
    {
      $stmt='insert into `'.$em.'` ('.$cnm.') values ('.$sid.');';
      $que=$cmd->query($stmt);
      echo "Added to ".$cnm;
    }
  }
  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
?>
