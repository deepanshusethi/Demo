<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
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
</head>
<body>
<div class="">
  <header>
<form>
  <input id="srfl" type="text" name="snme" size=50 placeholder="Search..."><br>
  <input list="art" name="dib" placeholder="Artist" onchange="resg(this.value,this.placeholder)" autocomplete="off">
   <datalist id="art">
     <option value="Amy Winehouse">
     <option value="Linkin Park">
     <option value="Bring Me The Horizon">
   </datalist>
  <input list="alb" name="dib" placeholder="Album" onchange="resg(this.value,this.placeholder)"  autocomplete="off">
   <datalist id="alb">
     <option value="Back To Black">
     <option value="One More Light">
     <option value="That`s The Spirit">
   </datalist>
 <input list="gen" name="dib" placeholder="Genre" onchange="resg(this.value,this.placeholder)"  autocomplete="off">
   <datalist id="gen">
     <option value="Rock">
     <option value="Pop">
     <option value="Electronic">
     <option value="Bollywood">
     <option value="Clasical">
   </datalist>
 <input list="tim" name="dib" placeholder="Age" onchange="resg(this.value,this.placeholder)" autocomplete="off">
   <datalist id="tim">
     <option value="Today`s">
     <option value="2000s">
     <option value="90s">
     <option value="70s">
     <option value="50s">
   </datalist>
 <input list="lan" name="dib" placeholder="Language" onchange="resg(this.value,this.placeholder)" autocomplete="off">
   <datalist id="lan">
     <option value="Hindi">
     <option value="Punjabi">
     <option value="English">
     <option value="Spanish">
   </datalist>
 <input type="button" value="Search" onclick="srch()">
 </form>
 </header>
</div>
 <select name="ene" id="artist" hidden > </select>
 <select name="ene" id="album"  hidden> </select>
 <select name="ene" id="genre"  hidden> </select>
 <select name="ene" id="age"    hidden> </select>
 <select name="ene" id="language" hidden> </select>
 <p id="ls"></p>
<nav class="">
  <a href="">Favourites</a><br>
  <input type="button" value="Add to Fav" onclick="favr()">
  Your Playlists:
   <nav id="ypl"></nav>
</nav>
<input type="button" value="Create Playlist" onclick="crtpl()">
<input id="plnm" type="text" placeholder="Enter Playlist Name" hidden onchange="crtpl()">
<p id="plpg"></p>
<br><br>
<div class="">
 <input id="ppb" type="button" value="Play" onclick="pp()">
 <input type="button" value="Next" onclick="nxt()">
 <input id="pen" type="button" value="Prev" onclick="prev()" disabled><br>
Volume: <input type="Range" value=100 min=10 max=100 onchange="vol(this.value)"><br>
Seek: <span id="curtm"></span> <input id="sek" type="Range" value=0 min=0 onchange="seek(this.value);"><span id="ttm"></span>
</div>
<div>
  <span><audio id="aud" onended="nxt()"></audio></span>
  <br> Currently Playing: <span id="cprl"></span><br>
</div>
<p id="dummy"></p>
</body>
<?php
  //$val = $_REQUEST['iv'];
  
  $stmt='create table if not exists `billy@the.kid` (favourites int unique) ;';
  try
  {
   $cmd = new PDO('mysql:host=localhost;dbname=accounts', 'ext_user', '');
   $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $que=$cmd->query($stmt);
   $stmt='select favourites from `billy@the.kid` ;';
   $que=$cmd->query($stmt);
   $hld=[];
   $i=0;
   while($res=$que->fetch(PDO::FETCH_NUM))
    {
      $hld[]=$res[0];
    }
    $cmd=null;
    $cmd = new PDO('mysql:host=localhost;dbname=user_song_info', 'ext_user', '');
    while($i<count($hld))
     {
       $stmt='select title from song_list where sid='.$hld[$i].';';
       $que=$cmd->query($stmt);
       $res=$que->fetch(PDO::FETCH_NUM);
       $hld[$i]=$res[0];
       $i++;
     }


  }
  catch(PDOException $e)
  {
     echo "Connection failed: " . $e->getMessage();
  }
?>
<script>
 var plst=[];
 var i=0,ppb=document.getElementById("ppb"),v,t,u;
 var aud=document.getElementById("aud");
    plst[0]='<?php echo json_encode($hld);?>';
    plst=JSON.parse(plst[0]);
    document.getElementById("cprl").innerHTML=plst[0];
    while(i<plst.length)
    {

      document.getElementById('ls').innerHTML+=plst[i]+"<br>";
      plst[i]="song_list/"+plst[i]+".mp3";
      i++;
    }
 i=1;
  aud.src=plst[0];
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
{
    i-=2;
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
  var id=aud.src;
  id=id.split('t/');
  id=id[2].split('.mp3');
  id=id[0].split('%20');
  id=id.join(" ");
document.getElementById("cprl").innerHTML=id;
  var m=0,s=aud.duration;
  while(s>60)
  {
    m++;
    s-=60;
  }
  document.getElementById("ttm").innerHTML=m+":"+parseInt(s);
  u=setInterval(upd,2000);
}
function seek(t)
{
  aud.currentTime=t;
}
function upd()
{ var m=0,s=aud.currentTime;
  document.getElementById("sek").value=aud.currentTime;
  while(s>60)
  {
    m++;
    s-=60;
  }
  document.getElementById("curtm").innerHTML=m+":"+parseInt(s);
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
         document.getElementById("ls").innerHTML=document.getElementById("srfl").value;
         document.getElementById("cprl").innerHTML=document.getElementById("srfl").value;;
       }
       else {
         document.getElementById("ls").innerHTML="No Such Song Found";
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
      document.getElementById("cprl").innerHTML=plst[0];
      n=0;
      document.getElementById("ls").innerHTML="";
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
{document.getElementById("ls").innerHTML="Please Enter an Input String";}
}

function favr()
{
  {
    var agnt = new XMLHttpRequest();
    var em='billy@the.kid';
    var id=aud.src,idp;
    id=id.split('t/');
    id=id[2].split('.mp3');
    idp=id[0].split('%20');
    idp=idp.join(" ");
   agnt.onreadystatechange = function()
   {
    if (this.readyState == 4 && this.status == 200)
     {
      document.getElementById("ls").innerHTML=idp;
     }
   }
   agnt.open("GET", "favor.php?em="+em+"&id="+id[0], true);
   agnt.send();
  }
}

function crtpl()
{
  var plnm=document.getElementById("plnm");
  plnm.hidden=false;
  if(plnm.value=="")
  {
    document.getElementById("plpg").innerHTML="Please Enter a Name";
  }
  else
  {
   op=document.createElement("input");
   op.type='button';
   op.value=plnm.value;
   document.getElementById("ypl").appendChild(op);
   document.getElementById("plpg").innerHTML="Playlist createds";
   plnm.value="";
   plnm.hidden=true;
  }
  //document.getElementById("ypl").innerHTML="new playlist"
}
//document.getElementById("dummy").innerHTML=plst[0];
</script>
</html>
