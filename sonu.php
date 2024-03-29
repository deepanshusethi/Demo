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
<!DOCTYPE html>
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
<meta charset="UTF-8">
  <title>Welcome <?= $first_name.' '.$last_name ?></title>
  <?php include 'css/css.html'; ?>
<style>

</style>
<link href="after.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css" media="screen">
</head>
 <header1>
  <div id ="header">
<h2 id="logo ">
            <a href="profile.php"><img src = "logo.png" style=" width: 20%;height:250px; float:left;" alt = logo/>
		   
 <div class="form">

         
          
          <p>
          <?php 
     
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
          
          ?>
          </p>
          
          <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }
          
          ?>
          
          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>
          
          <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

    </div>



<br style="clear:both;"/>

</div></a></h2>
</header1>
<body>

    
<script src='js1.js'></script>
<script src="js/index.js"></script>
<div class="container">
  <a href="profile.php">Home</a>
  
  <div class="dropdown">
    <button class="dropbtn">moods</button>
    <div class="dropdown-content">
      <a href="happy.php">happy</a>
      <a href="sad.php">sad</a>
      <a href="romantic.php">romantic</a>
      
      <a href="heartbroken.php">heart broken</a>
      <a href="party.php">party</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Era</button>
    <div class="dropdown-content">
      <a href="60.php">50's-90's </a>
      
      <a href="90.php">90's-2010's</a>
      
      <a href="newEra.php">New Era</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">singer's</button>
    <div class="dropdown-content">
      <a href="lata.php">Lata Mangeshkar</a>
      <a href="jagjit.php">Jagjit Singh</a>
      <a href="rahman.php">A.R. Rahman</a>
      <a href="ankit.php">Ankit Tiwari</a>
      <a href="arijit.php">Arijit Singh</a>
      <a href="sonu.php">Sonu Nigam</a>
      
      
      <a href="mohit.php">Mohit Chauhan</a>
      
      <a href="kishore.php">Kishore Kumar</a>
      <a href="rafi.php">Mohammand Rafi</a>
      
    </div>
  </div>
  
</div>


<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    
    <a href="favourites.php">your favourites</a>
    <a href="feedback.php">feedback</a>
  </div>
</div>


<span style="font-size:30px;cursor:pointer;float:right" onclick="openNav()">&#9776; profile</span>

<script>
function openNav() {
    document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.height = "0%";
}
</script>
<form>
  <input type="text" name="search" placeholder="Search..">
</form>
<h2 id="playlist1 ">
            <a href="playlist.php"><img src = "road.png" style=" width: 150px;height:150px; float:left;" alt = playlist1/>
			
			</a><h2>
<div id="container">
	<div id="audio-image">
		<img class="cover" />
	</div>
	<div id="audio-player">
		<div id="audio-info">
			<span class="artist"></span> - <span class="title"></span>
		</div>
		 <input id="volume" type="range" min="0" max="10" value="5" />
		 <br>
		 <div id="buttons">
		 <span>
			<button id="prev"></button>
			<button id="play"></button>
			<button id="pause"></button>
			<button id="stop"></button>
			<button id="next"></button>
			</span>
		 </div>
		 <div class="clearfix"></div>
		 <div id="tracker">
			<div id="progressBar">
				<span id="progress"></span>
			</div>
			<span id="duration"></span>
		 </div>
		 <div class="clearfix"></div>
		 <ul id="playlist" class="hidden">
			<li song="Allah Maaf Kare.mp3" cover="sonu.jpg" artist="sonu nigam">Allah Maaf Kare.mp3</li>
			<li song="Chori Kiya Re Jiya .mp3" cover="sonu.jpg" artist="sonu nigam">Chori Kiya Re Jiya.mp3</li>
			<li song="Jeene Ke Hain Chaar Din.mp3" cover="sonu.jpg" artist="sonu nigam">Jeene Ke Hain Char Din.mp3</li>
			<li song="Nagada Nagada.mp3" cover="sonu.jpg" artist="sonu nigam">Nagada Nagada.mp3</li>
			<li song="Rehnaa Hai Tere Dil Mein.mp3" cover="sonu.jpg" artist="sonu nigam">Rehna Hai Tere Dil Mein .mp3</li>
		
			
		</ul>
	</div>

</div>

<script src="js/jquery1.js"></script>
<script src="js/main1.js"></script>
     
</body>
</html>
