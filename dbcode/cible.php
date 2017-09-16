
<?php 
$pseudo = $_POST['pseudo'];
try
{
$bdd = new PDO('mysql:host=localhost;dbname=meh', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->query("SELECT credits,fiche FROM membres WHERE pseudo='".$pseudo."'");

?>


    <head>
        <meta charset="utf-8">
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>DUAL BET</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		
        <link rel="stylesheet" href="css/normalize.css">
				<link rel="stylesheet" media="screen" href="plugin/bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-responsive.min.css">
				<link rel="stylesheet" href="plugin/font-awesome/css/font-awesome.min.css">
				<!--[if IE 7]>
					<link rel="stylesheet" href="plugin/font-awesome/css/font-awesome-ie7.min.css">
				<![endif]-->
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
		
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

<!--==========================================================================
     Header Unit (LOGO & Slogan)
    ==========================================================================-->
<div class="row-fluid">
	<div class="span12 slogan text-center">
		<img class="logo" src="image/logo.jpg" alt="logo">
		<h1><?php print ("Bienvenue sur DUAL BET $pseudo")?><br>
		
<?php while ($donnees = $reponse->fetch())
{
?>
    <small>
     Vous disposez de <?php echo $donnees['credits']; ?> €<br />
	 Votre mise est de : <?php echo $donnees['fiche'];?> €<br/>
	 <?php if($donnees['fiche']>=$donnees['credits'])
		{
			echo ("ATTENTION VOTRE MISE EST SUPÉRIEUR A VOS CRÉDITS");
			
		}?>	
   </small></h1>
<?php
}
 
$reponse->closeCursor(); // Termine le traitement de la requête
 
?>		
		<form action="DB.php" method="post">
		<input type="hidden" name="pseudo" value="<?php echo"".$pseudo.""?>"></input>
<center><input type="submit" value="Jouer" /></center>
</form>
	</div>
</div>



	<!--==========================================================================-->


<!--==========================================================================
     Connect your app with url to store.
    ==========================================================================-->

<div class="row-fluid">
	<div class="span12 text-center" style="margin-top:4%;">
		<a href="#"><img class="span2 offset4" src="image/app-store.png" alt="App store" style="margin-right:2%;"></a>
		<a href="#"><img class="span2" src="image/google-play.png" alt="Google play"></a>
	</div>
</div>



<!--==========================================================================
     Social Network Unit
    ==========================================================================-->

<div class="row-fluid">
	<div class="span12 text-center" style="margin-top:5%;">
			<a class="social" href="#"><i class="icon-twitter icon-2x"></i></a>
			<a class="social" href="#"><i class="icon-google-plus icon-2x"></i></a>
			<a class="social" href="#"><i class="icon-facebook icon-2x"></i></a>
	</div>
</div>


<!--==========================================================================
     Footer Unit
    ==========================================================================-->

<footer>
	<div class="row-fluid footer">
		<div class="span12">
			<p class="copyright text-right"><small>all rights reserved © 2014</small></p>
		</div>
	</div>
</footer>









<!--==========================================================================
     Javascript Unit
				-connect your Google Analytics account easily.
    ==========================================================================-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
				<script src="plugin/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<!--
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
-->

    </body>
</html>
