<?php session_start();?>
<!DOCTYPE html>
<html>
    <?php
        include("../config/config.php");
    ?>
	<head>
		<title>Les cartes listiques</title>
		<link href="../style/style.css" rel="stylesheet" media="all" type="text/css">
        <link href="../style/mini_responsive.css" rel="stylesheet" media="all" type="text/css">
	</head>
	<body class="fond-rose">

		<header class="fond-violet">
			<?php include("entete.php");?>
		</header>
		<?php include("contenu.php");?>
        <script type="text/javascript" src="../scripts/jquery.js"></script>
        <script type="text/javascript" src="../scripts/ajax.js"></script>
        <script type="text/javascript" src="../scripts/navigation.js"></script>
	</body>
</html>