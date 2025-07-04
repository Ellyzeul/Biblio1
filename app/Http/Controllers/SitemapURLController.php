<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SitemapURL;

class SitemapURLController extends Controller
{
	public function __invoke()
	{
		$sitemapURL = new SitemapURL();

		$sitemapURL->generateSitemaps();
	}

	public function create()
	{
		$this->__invoke();

		return [
			"message" => "Sitemaps gerados!!"
		];
	}
}
