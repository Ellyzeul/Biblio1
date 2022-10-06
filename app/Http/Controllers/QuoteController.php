<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quote;

class QuoteController extends Controller
{
	public static function read() {
		$quote = new Quote();
		$result = $quote->read();

		return [
			$result->quote,
			$result->author,
		];
	}
}
