<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
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
  <head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146460540-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-146460540-1');
</script>

  <?php include 'css/css.html'; ?>
</head>
  
    <meta charset="utf-8">
    <title>Mood 4 Music</title>
    <style>
	
    </style>
	<link href="home1.css" type="text/css" rel="stylesheet">
	
  </head>
  <body background=(C:\Users\renju\Desktop\1.jpg)>
  
  <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}
?>
  <header1>
  <div id ="header">
<h2 id="logo ">
            <a href="index.php"><img src = "header.png" style=" width: 100%;height:150px; float:left;" alt = logo/>
		   




<br style="clear:both;"/>

</div></a></h2>
</header1>

  <div class="bb">
    <header>
	<div style ="font-size:40px;">
     <h1>How are you feeling..?</h1>
	 </div>
     </header>
     <form id="fom_id" action="Play.php"  autocomplete="off">
       <input id="ip_id" list="moods" name="qip" placeholder="ummm...." oninput="facpt()">
         <datalist id="moods">
           <option value="Happy" >
           <option value="Sad">
           <option value="Crazy">
           <option value="Loved">
           <option value="Lost">
         </datalist>
     </form>
    <br><br> <br><footer>Not so sure?.... Take a <a href="quiz.php">little quiz</a></footer></br>
   </div>
   <div class="aa">
     
      <div class="form">
      
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
          
          <button class="button button-block" name="login" />Log In</button>
          
          </form>

        </div>
          
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>
          
          <button type="submit" class="button button-block" name="register" />Register</button>
          
          </form>

        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<script>
  function facpt()
  {
    var ip=document.getElementById('ip_id').value,arr=["Happy","Sad","Crazy","Loved","Lost"],i=0,len=arr.length;
    while(i<len)
   { if (ip==arr[i])
     {
      document.getElementById('fom_id').submit();
      break;
     }
     i++;
   }
  }
</script>
  <script src='js1.js'></script>

    <script src="js/index.js"></script>

</html>
