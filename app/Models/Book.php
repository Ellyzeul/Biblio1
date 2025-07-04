<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
	use HasFactory;

	private string $defaultPageTitle = "Biblio1 - Busque títulos e compare preços";
	private int $paginationOffset = 200;

	/** Realiza a busca pelo termo na categoria selecionada
	 * 
	 * @param string $term
	 * @param string $by
	 */
	public function search(string $term, string $by)
	{
		if($by == "isbn") {
			$by = \strlen($term) == 13 ? "isbn13" : "isbn10";
		}

		$results = DB::table('books')
			->where($by, 'LIKE', '%' . $term . '%')
			->limit(50)
			->get();
		
		$total = count($results);
		$books = [];

		foreach($results as $result) {
			array_push($books, $result);
		}

		return [
			$total, 
			$books,
			$this->getPageTitle($books, $total),
			$this->getKeywords($books, $total)
		];
	}

	public function getPage(int $page)
	{
		$offset = $page < 1 
			? 0
			: $page - 1;

		$results = DB::table('books')
			->where('id', '>', $this->paginationOffset * $offset)
			->limit($this->paginationOffset)
			->get();

		$books = [];
		foreach($results as $book) {
			array_push($books, $book);
		}
		
		return $books;
	}

	public function getISBN(string $key, string $value)
	{
		if($key == 'isbn' && strlen($value) > 10) return $value;

		$key = $key == 'isbn' ? 'isbn10' : $key;
		$isbn = DB::table('books')
			->select('isbn13')
			->where($key, '=', $value)
			->get();
		
		return isset($isbn[0]) ? $isbn[0]->isbn13 : null;
	}

	private function getPageTitle(array $books, int $totalBooks)
	{
		if($totalBooks == 0) return $this->defaultPageTitle;
		if($totalBooks == 1) return $books[0]->title;

		if(isset($_GET['title'])) return "Livro: " . $_GET['title'];
		if(isset($_GET['author'])) return "Autor: " . $_GET['author'];
		if(isset($_GET['publisher'])) return "Editora: " . $_GET['publisher'];

		return $this->defaultPageTitle;
	}

	private function getKeywords(array $books, int $totalBooks)
	{
		if($totalBooks != 1) return $this->getKeywordsForList($books);

		$book = $books[0];
		$keywords = [];

		array_push($keywords, "ISBN", $book->isbn13, $book->isbn10);
		if(isset($book->title)) array_push($keywords, "Título", $book->title);
		if(isset($book->author)) array_push($keywords, "Autor", $book->author);
		if(isset($book->publisher)) array_push($keywords, "Editora", $book->publisher);

		return $keywords;
	}

	private function getKeywordsForList(array $books)
	{
		if(isset($_GET['ISBN'])) return ["Livro", $_GET['isbn']];
		if(isset($_GET['title'])) return ["Livro", $_GET['title']];
		if(isset($_GET['author'])) return ["Autor", $_GET['author']];
		if(isset($_GET['publisher'])) return ["Editora", $_GET['publisher']];

		return [];
	}
}
