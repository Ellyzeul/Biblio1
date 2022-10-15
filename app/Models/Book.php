<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
	use HasFactory;

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
		
		$isList = count($results) > 1;
		$books = [];

		foreach($results as $result) {
			array_push($books, $result);
		}

		return [
			$isList, 
			$books
		];
	}

	public function getISBN(string $key, string $value)
	{
		if($key == 'isbn') return $value;

		$isbn = DB::table('books')
			->select('isbn13')
			->where($key, '=', $value)
			->get();
		
		return $isbn[0]->isbn13;
	}
}
