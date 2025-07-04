<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CotationController;
use App\Http\Controllers\QuoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	[$quote, $quoteAuthor] = QuoteController::read();

	return view('home', [
		"quote" => $quote,
		"quote_author" => $quoteAuthor
	]);
});

Route::get('/resultado', function (Request $request) {
	[$quote, $quoteAuthor] = QuoteController::read();
	[$total, $books, $pageTitle, $keywords] = BookController::search($request);
	$isbn = BookController::getISBN($request);
	[$links, $selineLink] = CotationController::read($isbn);

	return view('result', [
		"quote" => $quote,
		"quote_author" => $quoteAuthor,
		"total" => $total,
		"books" => $books,
		"page_title" => $pageTitle,
		"keywords" => $keywords,
		"links" => $links,
		"seline_link" => $selineLink
	]);
});

Route::get('/catalogo/{pagination_code?}', function(string $pagination_code = "") {
	[$quote, $quoteAuthor] = QuoteController::read();
	$books = BookController::getPage($pagination_code);

	return view('catalog', [
		"quote" => $quote,
		"quote_author" => $quoteAuthor,
		"books" => $books
	]);
});

Route::get('/sobre.php', function() {
	return redirect('/');
});

Route::get('/{file}', function($file) {
	return redirect('/' . str_replace('.php', '', $file) . (isset($_SERVER['QUERY_STRING']) 
			? '?' . strtolower($_SERVER['QUERY_STRING']) 
			: ""
		)
	);
})
	->where('file', '[A-Za-z0-9-]+\.php.*');
