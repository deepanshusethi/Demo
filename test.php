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
<title>Welcome</title>
<link href="style22.css" type="text/css" rel="stylesheet">
</head>
<body>


  <header>
<form>

  <input id="srfl" type="text" name="snme" size=50 placeholder="Search..."><br>
  <div class="aa">
  <input list="art" type="text" name="dib" placeholder="Artist" onchange="resg(this.value,this.placeholder)" >
   <datalist id="art">
     <option value="Amy Winehouse">
     <option value="Linkin Park">
     <option value="Bring Me The Horizon">
   </datalist>
   </div>
 <br> <input list="alb" type="text" name="dib" placeholder="Album" onchange="resg(this.value,this.placeholder)">
   <datalist id="alb">
     <option value="Back To Black">
     <option value="One More Light">
     <option value="That`s The Spirit">
   </datalist>
 <br><input list="gen" type="text" name="dib" placeholder="Genre" onchange="resg(this.value,this.placeholder)">
   <datalist id="gen">
     <option value="Rock">
     <option value="Pop">
     <option value="Electronic">
     <option value="Bollywood">
     <option value="Clasical">
   </datalist>
 <br><input list="tim" type="text" name="dib" placeholder="Age" onchange="resg(this.value,this.placeholder)">
   <datalist id="tim">
     <option value="Today`s">
     <option value="2000s">
     <option value="90s">
     <option value="70s">
     <option value="50s">
   </datalist>
<br> <input list="lan" type="text" name="dib" placeholder="Language" onchange="resg(this.value,this.placeholder)">
   <datalist id="lan">
     <option value="Hindi">
     <option value="Punjabi">
     <option value="English">
     <option value="Spanish">
   </datalist>
<br> <input type="button" value="Search" onclick="srch()">
 </form>
 </header>


 <select name="ene" id="artist" hidden > </select>
 <select name="ene" id="album"  hidden> </select>
 <select name="ene" id="genre"  hidden> </select>
 <select name="ene" id="age"    hidden> </select>
 <select name="ene" id="language" hidden> </select>
 <p id="ls"></p>
<nav class="bb">
  <a href="">Favourites</a><br>
  Your Playlists:
   <nav>
     <a href=""><span>Playlist 1</span></a><br>
     <a href=""><span>Playlist 2</span></a><br>
   </nav>
</nav>
<input type="button" value="Create Playlist">
<br><br>
<div class="cc">
 <input id="ppb" type="button" value="Play" onclick="pp()">
 <input type="button" value="Next" onclick="nxt()">
 <input id="pen" type="button" value="Prev" onclick="prev()" disabled><br>
Volume: <input type="Range" value=100 min=10 max=100 onchange="vol(this.value)"><br>
Seek: <input id="sek" type="Range" value=0 min=0 onchange="seek(this.value);">
</div>
<div>
  <span><audio controls id="aud" onended="nxt()"></audio></span>
</div>
<p id="dummy"></p>
</body>
<?php
 /*if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
  $val = $_REQUEST['iv'];
  $cnme= $_REQUEST['ph'];
  $stmt='select distinct artist,album,genre from song_info where '.$cnme.'=\''.$val.'\';';
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
      echo $res[0].' '.$res[1].' '.'<br>';
    }
  }
  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
}*/
?>
<script>
 var plst=[];
 var i=0,f,ppb=document.getElementById("ppb"),v,t,u;
 /*var aud=document.getElementById("aud");
    plst[0]='<?php echo json_encode($hld);?>';
    plst=JSON.parse(plst[0]);
    f=plst.length;
    while(i<f)
    {
      plst[i]="song_list/"+plst[i]+".mp3";
      i++;
    }*/
 i=1;
 f=0;
 if(f==0)
 {
  f=1;
  aud.src=plst[0];
 }
 function nxt()
 {
    document.getElementById("pen").disabled=false;
    clearInterval(u);
    aud.src=plst[i];
    aud.load();
    i++;
    ppb.value="Play";
}
function prev()
{   i-=2;
    aud.src=plst[i];
    aud.load();
    i++;
    ppb.value="Play";
   if(i==1)
     {document.getElementById("pen").disabled=true;}
}
function pp()
{
  if(ppb.value=="Play")
  {
    aud.play();
    ppb.value="Pause";
    u=setInterval(upd,2000);
  }
  else
  { clearInterval(u);
    aud.pause();
    ppb.value="Play";
  }

}
function vol(v)
{
  aud.volume=(v/100);
}
aud.onloadeddata=function()
{
  document.getElementById("sek").max=aud.duration;
  u=setInterval(upd,2000);
}
function seek(t)
{
  aud.currentTime=t;
}
function upd()
{
  document.getElementById("sek").value=aud.currentTime;
}
var iv,ph;
function resg(iv,ph)
{var n=0;

  while(n<5)
  {
    if(document.getElementsByName('dib')[n].placeholder==ph)
    { n++;
      continue;
    }
    document.getElementsByName('dib')[n].hidden=true;
    n++;
  }
  ph=ph.toLowerCase();
  var agnt= new XMLHttpRequest();
  agnt.onreadystatechange=function()
  {
    if((this.readyState==4) && (this.status==200))
    { n=0;
      var ret=JSON.parse(this.responseText),j;
      while(n<5)
      { var sel=document.getElementsByName('ene')[n],op;
        if(sel.id==ph)
        { n++;
         continue;}
        sel.hidden=false;
        n++;
      }
      n=0;
      while(n<ret.length)
      { j=0;
        while(j<5)
        { var sel=document.getElementsByName("ene")[j],op;
          if(sel.id==ph)
          { j++;
           continue;}
          op=document.createElement("option");
          op.text=ret[n][j];
          sel.add(op);
          j++;
        }
        n++;
      }
    }
  }
  agnt.open("GET","seprate.php?iv="+iv+"&ph="+ph,true);
  agnt.send();
}
function srch()
{var n=0;

     while(n<5)
     { if(document.getElementsByName('ene')[n].hidden==false )
       {var chk=1;
         break;}
       n++;
     }
     n=0;
   if(document.getElementById("srfl").value!="")
   {
     var agnt = new XMLHttpRequest();
     var v=document.getElementById("srfl").value;
     agnt.onreadystatechange = function()
    {
     if (this.readyState == 4 && this.status == 200)
      {
       if(this.responseText!='[""]')
       {
         plst[0]="song_list/"+document.getElementById("srfl").value+".mp3";
         aud.src=plst[0];
         document.getElementById("dummy").innerHTML=document.getElementById("srfl").value;
       }
       else {
         document.getElementById("dummy").innerHTML="No Such Song Found";
       }
     }
    }
    agnt.open("GET", "searchspec.php?v="+v, true);
    agnt.send();
   }
 else if (chk==1)
 {
   var agnt = new XMLHttpRequest(),nhv,nhc;
   while(n<5)
   { if(document.getElementsByName('dib')[n].hidden==false )
     { nhv=document.getElementsByName('dib')[n].value;
      nhc=document.getElementsByName('dib')[n].placeholder.toLowerCase();
       break;}
     n++;
    }
     agnt.onreadystatechange = function()
  {
   if (this.readyState == 4 && this.status == 200)
    {
      plst=JSON.parse(this.responseText);
      n=0;
      while(n<plst.length)
      {
        document.getElementById("ls").innerHTML+=plst[n]+"<br>";
        plst[n]="song_list/"+plst[n]+".mp3";
        n++;
      }
         aud.src=plst[0];
    }
  }
  agnt.open("GET", "searchgiv.php?nhv="+nhv+"&nhc="+nhc, true);
  agnt.send();
 }
else
{document.getElementById("dummy").innerHTML="Please Enter an Input String";}
}
//document.getElementById("dummy").innerHTML=plst[0];
</script>
</html>
