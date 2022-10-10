<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/assets/css/global.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/result.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/navbar.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/search_box.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/quote.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/result_list.css') }}">
  <title>Biblio1 - Seu novo catalogo de livros online - Busque títulos e compare preços</title>
  <script src="{{ asset('/assets/js/components/search_box.js') }}" defer></script>
</head>
<body>
  <section id="result">
    <x-navbar />
    <div id="result-content">
      <div id="middle-container">
        <header id="result-topbar">
          <x-b1-logo />
          <div></div>
          <x-search-box />
          <x-quote :quote="$quote" :quote-author="$quote_author" />
          <hr>
        </header>
        @if($is_list)
          <x-result-list :books="$books" />
        @elseif(count($books) > 0)
          <x-result-by-isbn :book="$books[0]" />
        @else
          <div>Nenhum resultado para a pesquisa foi encontrado.</div>
        @endif
      </div>
    </div>
  </section>
</body>
</html>