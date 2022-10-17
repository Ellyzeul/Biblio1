<main id="isbn-result">
	<div id="isbn-result-cover-container">
		<img src="{{ $thumbnail }}" alt="">
	</div>
	<section id="book-description">
		<p><span>Título:</span> {{ $title }}</p>
		@if(isset($author))<p><span>Autor:</span> {{ $author }}</p>@endif
		@if(isset($publishser))<p><span>Editora:</span> {{ $publishser }}</p>@endif
		@if(isset($isbn10))<p><span>ISBN-10:</span> {{ $isbn10 }}</p>@endif
		<p><span>ISBN-13:</span> {{ $isbn13 }}</p>
		@if(isset($description))<p><span>Sinopse:</span> {{ $description }}</p>@endif
	</section>
	<section id="cotation">
		<h2>Cotações para o livro</h2>
		@foreach($links as $link)
			<x-cotation-row 
				:price="$link['price']" 
				:id-sellercentral="$link['id_sellercentral']" 
				:sellercentral="$link['sellercentral']" 
				:company="$link['company']" 
				:id-company="$link['id_company']" 
				:link="$link['link']" 
			/>
		@endforeach
	</section>
	<div id="iframe-container">
		<script type="text/javascript" src="https://books.google.com/books/previewlib.js"></script>
		<script type="text/javascript">GBS_setLanguage('pt-BR')</script>
		<script type="text/javascript">
			const iframeContainer = document.querySelector("#iframe-container")
			const { width } = iframeContainer.getBoundingClientRect()
			GBS_insertEmbeddedViewer('ISBN:{{ $isbn13 }}', width, 900)
			const container = document.querySelector("#__GBS_Button0")
			window.addEventListener('resize', () => {
				if(!container.firstChild) return
				container.children[0].style.width = iframeContainer
					.getBoundingClientRect()
					.width + "px"
			})
		</script>
		<div id="iframe-overlay"></div>
	</div>
</main>
