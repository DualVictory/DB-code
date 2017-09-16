<?php
$pseudo1 = $_POST['pseudo'];
try
{
$bdd = new PDO('mysql:host=localhost;dbname=meh', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}

// Connexion à MySQL
try
{
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
 
// -------
// ÉTAPE 1 : on vérifie si l'IP se trouve déjà dans la table.
// Pour faire ça, on n'a qu'à compter le nombre d'entrées dont le champ "ip" est l'adresse IP du visiteur.
$retour = $bdd->query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
$donnees = $retour->fetch();
 
if ($donnees['nbre_entrees'] == 0) // L'IP ne se trouve pas dans la table, on va l'ajouter.
{
$bdd->query('INSERT INTO connectes VALUES(\'' . $_SERVER['REMOTE_ADDR'] . '\', ' . time() . ')');
}
else // L'IP se trouve déjà dans la table, on met juste à jour le timestamp.
{
$bdd->query('UPDATE connectes SET timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
echo $_SERVER['REMOTE_ADDR'];
}
 
// -------
// ÉTAPE 2 : on supprime toutes les entrées dont le timestamp est plus vieux que 5 minutes.
 
// On stocke dans une variable le timestamp qu'il était il y a 5 minutes :
$timestamp_15min = time() - (60 * 15); // 60 * 15 = nombre de secondes écoulées en 15 minutes
$bdd->query('DELETE FROM connectes WHERE timestamp < ' . $timestamp_15min);
 
// -------
// ÉTAPE 3 : on compte le nombre d'IP stockées dans la table. C'est le nombre de visiteurs connectés.
$retour = $bdd->query('SELECT COUNT(*) AS nbre_entrees FROM connectes');
$donnes =$retour->fetch();
 

 
$retour->closeCursor();
 
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
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
		<ul id="menu-demo2">
	<li><a href="index.html">ACCUEIL</a>
	</li>
	<li><a href="connexion.html">Votre compte</a>
	
	</li>
	<li><a href="#">REGLES DU JEU</a>
		<ul>
			<li><a href="#">Présentation</a></li>
			<li><a href="#">On verra</a></li>
			<li><a href="#">On verra</a></li>
			<li><a href="#">On verra</a></li>
		</ul>
	</li>
	
</ul>
    </head>
    <body>
	<form action="connexion.html" method="post">
	<div class="row-fluid">
	<div class="span12 slogan text-center">
		<img class="logo" src="image/logo.jpg" alt="logo">
		<h1>Bienvenue sur DUAL BET<br> <small>Le jeu d'argent équitable<br></small>
<?php
$parij=rand(1,1000000);
$pari =$bdd->query("SELECT pari FROM membres WHERE pseudo = '".$pseudo1."'");
while ($recuppari =$pari->fetch())
{
	$monpari = $recuppari['pari'];
}
$jconnect=$bdd->query("SELECT pari,pseudo FROM membres,connectes WHERE membres.ip =connectes.ip AND fiche = (SELECT membres.fiche FROM membres WHERE pseudo ='".$pseudo1."')LIMIT 1 ");
while($tableau =$jconnect->fetch())
{

	if (($tableau['pari']>$monpari))
	{
	?>	<h1><?php print ("Le gagnant est'".$tableau['pseudo']."'");?> </h1>
	<?php 
	$bdd->query("UPDATE membres SET credits=credits + fiche WHERE pseudo='".$tableau['pseudo']."'");
	$bdd->query("UPDATE membres SET credits=credits - fiche WHERE pseudo='".$pseudo1."'");
	$bdd->query("UPDATE membres SET fiche=2 WHERE pseudo='".$tableau['pseudo']."'");
	$bdd->query("UPDATE membres SET fiche=fiche*2 WHERE pseudo ='".$pseudo1."'");
	
	}
	if (($tableau['pari'] < $monpari))
	{
	?>	<h1><?php print ("Le gagnant est '".$pseudo1."'");?></h1>
	<?php
	$bdd->query("UPDATE membres SET credits=credits - fiche WHERE pseudo='".$tableau['pseudo']."'");
	$bdd->query("UPDATE membres SET credits=credits + fiche WHERE pseudo='".$pseudo1."'");
	$bdd->query("UPDATE membres SET fiche=2 WHERE pseudo='".$pseudo1."'");
	$bdd->query("UPDATE membres SET fiche=fiche*2 WHERE pseudo ='".$tableau['pseudo']."'");
	}
	if (($tableau['pseudo'] = $pseudo1) AND ($tableau['pari']=$monpari))
	{
		?>
		<small><?php print ("Personne n'a une fiche similaire à la votre, veuillez réessayer plus tard");?></small>
		<?php
	}
	

}
$jconnect->closeCursor();


$bdd->query("UPDATE membres SET pari='".$parij."' WHERE pseudo='".$pseudo1."'");


?>
		
		<h1><small><input type="submit" value="Votre Compte" /></small></h1>
	</div>
</div>
    

</form>

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
