<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('/assets/css/global.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/home.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/navbar.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/b1_logo.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/search_box.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/quote.css') }}">
	<title>Biblio1 - Seu novo catalogo de livros online - Busque títulos e compare preços</title>
	<script src="{{ asset('/assets/js/components/search_box.js') }}" defer></script>
</head>
<body>
	<section id="home">
		<x-navbar/>
		<div id="home-content">
			<x-b1-logo />
			<div id="middle-container">
				<x-search-box />
				<x-quote :quote="$quote" :quote-author="$quote_author" />
			</div>
		</div>
	</section>
</body>
</html>
