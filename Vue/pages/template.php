<!--template commun à toutes les pages, il permet de faire tous les imports nécessaires pour toutes les pages-->
<!DOCTYPE html>
<html>
	<head>
		<title>Les cartes listiques</title>
		<link href="style/style.css" rel="stylesheet" media="all" type="text/css">
        <link href="style/mini_responsive.css" rel="stylesheet" media="all" type="text/css">
	</head>
	<body class="fond-rose">

		<header class="fond-violet">
			<?php include_once("entete.php");?>
		</header>
		<?php include_once("contenu.php");?>
        <script type="text/javascript" src="scripts/js/jquery.js"></script>
        <script type="text/javascript" src="scripts/js/ajax.js"></script>
        <script type="text/javascript" src="scripts/js/navigation.js"></script>
        <?php
            if ($_SESSION['template']['page'] == $pages['Carte'])
                echo '<script type="text/javascript" src="scripts/js/carte.js"></script>';
        ?>
	</body>
</html>