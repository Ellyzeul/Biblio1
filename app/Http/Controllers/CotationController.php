<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cotation;

class CotationController extends Controller
{
	public static function read(string $isbn)
	{
		$cotation = new Cotation();

		$result = $cotation->read($isbn);

		return $result;
	}
}
