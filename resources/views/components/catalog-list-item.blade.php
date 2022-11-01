<section class="catalog-list-item">
	<div>
		<div><span>Título:</span> {{ $title }}</div>
		@if(isset($publisher))<div><span>Editora:</span> {{ $publisher }}</div>@endif
		@if(isset($author))<div><span>Autor:</span> {{ $author }}</div>@endif
		<div><span>ISBN-13:</span> {{ $isbn13 }}</div>
		@if(isset($isbn10))<div><span>ISBN-10:</span> {{ $isbn10 }}</div>@endif
	</div>
	<a href="/resultado?isbn={{ $isbn13 }}"></a>
</section>
