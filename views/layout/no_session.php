<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Titre de la page</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>public/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
	<body class="grey lighten-2">
		<header>
			<nav class="nav-extended indigo">
				<div class="nav-wrapper">
					<a href="#" class="brand-logo center light">The bet-Line</a>
					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="<?=WEBROOT?>">Les Matchs</a></li>
						<li><a href="<?= WEBROOT?>user/display_inscription">Inscription</a></li>
						<li><a href="<?= WEBROOT?>user/display_connexion">Connexion</a></li>
					</ul>
					<ul class="side-nav" id="mobile-demo">
						<li><a href="<?=WEBROOT?>">Les Matchs</a></li>
						<li><a href="<?= WEBROOT?>user/display_inscription">Inscription</a></li>
						<li><a href="<?= WEBROOT?>user/display_connexion">Connexion</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<main>
			<div class="container">
				<? echo $content_for_layout ?> 
			</div>
		</main>
		<footer class="page-footer indigo">
			<div class="container">
				<div class="row">
					<div class="col l6 s12">
						<h5 class="white-text">Par la création de louis</h5>
						<p class="grey-text text-lighten-4">Le réalisateur de ce site est louis</p>
					</div>
					<div class="col l4 offset-l2 s12">
						<h5 class="white-text">Les liens</h5>
						<ul>
							<li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					© 2017 Copyright Text
					<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
				</div>
			</div>
		</footer>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		<script src="<?= WEBROOT?>public/script.js"></script>
	</body>
</html>