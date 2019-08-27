<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146460540-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-146460540-1');
</script>
</head>
<body>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // collect value of input field
      $name = $_REQUEST['xx'];
      if (empty($name)) {
          echo "Name is empty";
      } else {
          echo $name;
      }
  }
  ?>

<form id="a" name="xx" method="post" action="" onsubmit="func()">
  Name: <input type="text" name="fname">
  <input type="submit">
</form>


<script>
function func()
{document.getElementById('a').action='<?php echo $_SERVER['PHP_SELF'];?>'
document.getElementById('a').value=20;}
</script>

try
{
 $cmd = new PDO('mysql:host=localhost;dbname=user_song_info', 'ext_user', '');
 $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $que=$cmd->query('select * from song_list;');
 $i=0;
 $hld=[];
 while($res=$que->fetch(PDO::FETCH_ASSOC))
  {
    $hld[$i]=$res["title"];
    $i++;
  }
}
catch(PDOException $e)
{
   echo "Connection failed: " . $e->getMessage();
}
