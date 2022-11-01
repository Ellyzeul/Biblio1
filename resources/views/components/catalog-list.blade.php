<main id="result-list">
	@foreach($books as $book)
		<x-catalog-list-item 
			:isbn13="$book->isbn13"
			:isbn10="$book->isbn10"
			:title="$book->title"
			:author="$book->author"
			:publisher="$book->publisher"
			:thumbnail="$book->thumbnail"
			:description="$book->description"
		/>
	@endforeach
</main>
