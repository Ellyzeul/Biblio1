<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\URLFormatter;

class BookController extends Controller
{
	private static array $searchFilters = [
		"isbn",
		"title",
		"author",
		"publisher"
	];

	/** Realiza a busca pelo termo na categoria selecionada
	 * 
	 * @param Request $request
	 */
	public static function search(Request $request)
	{
		$book = new Book();

		$by = null;
		foreach(BookController::$searchFilters as $acceptableFilter) {
			if($request->has($acceptableFilter)) {
				$by = $acceptableFilter;
				break;
			}
		}

		$term = $request->input($by);

		$result = $book->search($term, $by);

		return $result;
	}

	public static function getPage(string $pagination_code)
	{
		$book = new Book();
		$urlFormatter = new URLFormatter();
		$page = $urlFormatter->decryptPaginationCode($pagination_code);

		$response = $book->getPage($page);

		return $response;
	}

	public static function getISBN(Request $request)
	{
		$book = new Book();

		$by = null;
		foreach(BookController::$searchFilters as $acceptableFilter) {
			if($request->has($acceptableFilter)) {
				$by = $acceptableFilter;
				break;
			}
		}

		$term = $request->input($by);

		$result = $book->getISBN($by, $term);

		return $result;
	}
}
