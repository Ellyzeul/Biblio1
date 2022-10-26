<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-20712069-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-20712069-1');
  </script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="{{ implode(', ', $keywords) }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/global.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/result.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/navbar.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/search_box.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/quote.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/components/result_list.css') }}">
  <title>{{ 
    strlen($page_title) < 70 
    ? $page_title 
    : (substr($page_title, 0, 66) . "...") 
  }}</title>
  <script src="{{ asset('/assets/js/components/search_box.js') }}" defer></script>
</head>
<body>
  <section id="result">
    <x-navbar />
    <div id="result-content">
      <div id="seline-banner">
        <h1>Resultados</h1>
        @if($total == 1)
          <a href="{{ $seline_link }}">
            <img src="/assets/img/seline-banner.jpeg" alt="">
          </a>
        @endif
      </div>
      <div id="middle-container">
        <header id="result-topbar">
          <x-b1-logo />
          <div></div>
          <x-search-box />
          <x-quote :quote="$quote" :quote-author="$quote_author" />
          <hr>
        </header>
        @if($total > 1)
          <x-result-list :books="$books" />
        @elseif($total == 1)
          <x-result-by-isbn :book="$books[0]" :links="$links" />
        @else
          <div>Nenhum resultado para a pesquisa foi encontrado.</div>
        @endif
      </div>
    </div>
  </section>
</body>
</html>