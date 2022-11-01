<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Catálogo de livros do Biblio1">
  <meta name="keywords" content="livros, catálogo, pesquisa, autor, editora, isbn">
  <title>Biblio1 - Catálogo de livros</title>
  <link rel="stylesheet" href="{{ asset('/assets/css/global.css')  }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/catalog.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/components/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/components/search_box.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/components/quote.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/components/catalog_list.css') }}">
  <script src="{{ asset('/assets/js/search_box.js') }}" defer></script>
</head>
<body>
  <div id="catalog">
    <x-navbar/>
    <div id="catalog-container">
      <h1>Biblio1</h1>
      <header id="catalog-topbar">
        <x-b1-logo />
        <div></div>
        <x-search-box />
        <x-quote :quote="$quote" :quote-author="$quote_author" />
        <hr>
      </header>
      <main>
        <x-catalog-list :books="$books" />
      </main>
    </div>
  </div>
</body>
</html>