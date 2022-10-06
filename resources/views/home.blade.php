<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('/assets/css/global.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/home.css') }}">
	<title>Biblio1 - Seu novo catalogo de livros online - Busque títulos e compare preços</title>
	<script  src="{{ asset('/assets/js/home.js') }}" defer></script>
</head>
<body>
	<div id="home">
		<nav id="navbar"></nav>
		<main id="home-content">
			<img id="logo" src="/assets/img/b1logo.gif" alt="Biblio1 - Busque títulos e compare preços">
			<section id="search-box">
				<input id="search-filter" type="text">
				<div id="filter-options">
					<div class="filter-option-selected">ISBN</div>
					<div class="filter-option">TÍTULO</div>
					<div class="filter-option">AUTOR</div>
					<div class="filter-option">EDITORA</div>
				</div>
				<div id="search-input-container">
					<input type="text" name="" id="search-input">
					<button id="search-button"><img src="/assets/img/search.gif" alt="Pesquisar"></button>
				</div>
				<div id="quote">
					<p>
						<span>“</span>
						{{ $quote }}
						<span>”</span>
					</p>
					{{ $quote_author }}
				</div>
			</section>
		</main>
	</div>
</body>
</html>
