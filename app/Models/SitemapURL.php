<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;
use Spatie\Sitemap\Tags\Url;

class SitemapURL extends Model
{
	use HasFactory;

	private string $domain = "https://biblio1.com.br";
	private int $bookPaginationOffset = 20000;

	public function generateSitemaps()
	{
		$total = $this->getTotalPages();

		for($i = 1; $i <= $total; $i++) {
			$sitemap = Sitemap::create();
			$urls = $this->getPageURLs($i-1);

			foreach($urls as $url) {
				$sitemap->add(
					Url::create($url)
						->setLastModificationDate(Carbon::now('America/Sao_Paulo'))
						->setChangeFrequency('')
						->setPriority(1)
				);
			}
			$sitemap->writeToFile(\public_path() . \DIRECTORY_SEPARATOR . $this->getSitemapName($i));
		}

		$index = SitemapIndex::create();
		for($j = 1; $j <= $total; $j++) {
			$index->add(
				SitemapTag::create($this->domain . '/public/' . $this->getSitemapName($j))
					->setLastModificationDate(Carbon::now('America/Sao_Paulo'))
			);
		}
		$index->writeToFile(\public_path() . \DIRECTORY_SEPARATOR . 'sitemap_index.xml');
	}

	private function getSitemapName(int $num)
	{
		return 'sitemap' . str_pad(strval($num), 3, '0', \STR_PAD_LEFT) . '.xml';
	}

	private function getPageURLs(int $page)
	{
		$books = DB::table('books')
			->select('isbn13')
			->where('id', '>', $page * $this->bookPaginationOffset)
			->limit($this->bookPaginationOffset)
			->get()
			->toArray();
		
		$urls = array_map(fn ($book) => $this->domain . '/resultado?isbn=' . $book->isbn13, $books);

		return $urls;
	}

	private function getTotalPages()
	{
		$total = DB::table('books')
			->where('isbn13', '<>', 'NULL')
			->count();
		
		return intval(ceil($total / $this->bookPaginationOffset));
	}
}
