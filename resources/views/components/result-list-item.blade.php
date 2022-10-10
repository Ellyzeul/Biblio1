<section class="result-list-item">
	<img class="result-list-item-cover" src="{{ $thumbnail }}" alt="Capa do livro">
	<div>
		<div><span>Título:</span> {{ $title }}</div>
		<div><span>ISBN-13:</span> {{ $isbn13 }}</div>
		@if(isset($isbn10))<div><span>ISBN-10:</span> {{ $isbn10 }}</div>@endif
		@if(isset($publisher))<div><span>Editora:</span> {{ $publisher }}</div>@endif
	</div>
	<a href="/resultado?isbn={{ $isbn13 }}"></a>
</section>
