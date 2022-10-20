<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cotation extends Model
{
	use HasFactory;

	private array $amazonSellerCodes = [
		null,
		"A2G32DFNLBV97X",
		"A3MHMSHG2GA0MT",
	];

	public function read(string | null $isbn)
	{
		if($isbn == null) return [[], null];

		$results = DB::table('cotations')
			->join('companies', 'cotations.id_company', '=', 'companies.id')
			->join('sellercentrals', 'cotations.id_sellercentral', '=', 'sellercentrals.id')
			->select(
				'cotations.isbn',
				'cotations.price',
				'cotations.url_identifier',
				'companies.id as id_company',
				'companies.name as company',
				'sellercentrals.id as id_sellercentral',
				'sellercentrals.name as sellercentral',
			)
			->where('isbn', '=', $isbn)
			->get();

		$general = null;
		$seline = null;
		$links = [];
		$pushed = [];
		foreach($results as $result) {
			$toAppend = [
				"price" => $result->price,
				"sellercentral" => $result->sellercentral,
				"id_sellercentral" => $result->id_sellercentral,
				"company" => $result->company,
				"id_company" => $result->id_company,
				"link" => $this->getLink(
					$result->isbn,
					$result->url_identifier,
					$result->id_sellercentral,
					$result->id_company,
				)
			];

			if($result->company == "general") {
				$general = $toAppend;
				continue;
			}
			if($result->price == "0.00" && $result->id_sellercentral != "SELINE") continue;
			if($result->id_sellercentral == "SELINE") {
				$seline = "https://www.livrariaseline.com.br/produtos/" . $result->url_identifier;
			}

			array_push($links, $toAppend);
			$pushed[$result->id_sellercentral] = true;
		}

		$response = [
			count($links) > 0
			? (isset($pushed["AMAZON"]) || $general == null ? $links : array_merge($links, [$general]))
			: ($general != null ? [$general] : []),
			$seline != null
			? $seline
			: "https://www.livrariaseline.com.br"
		];
		
		return $response;
	}

	private function getLink(string $isbn, string $urlIdentifier, string $idSellercentral, int $idCompany)
	{
		if($idSellercentral == "AMAZON") return $this->getAmazonURL(
			$isbn, 
			$urlIdentifier,
			$this->amazonSellerCodes[$idCompany]
		);
		if($idSellercentral == "SELINE") return $this->getSelineURL(
			$urlIdentifier
		);
	}

	private function getAmazonURL(string $isbn, string $asin, string | null $sellerCode)
	{
		return isset($sellerCode)
			? "https://www.amazon.com.br/dp/$asin/ref=sr_1_1?__mk_pt_BR=%C3%85M%C3%85%C5%BD%C3%95%C3%91&keywords=$isbn&m=$sellerCode&_encoding=UTF8&tag=wwwbiblio1com-20&linkCode=ur2&linkId=66cc781dc445f7aff0f3cb1ed14c3c29&camp=1789&creative=9325"
			: "https://www.amazon.com.br/dp/$asin/ref=sr_1_1?__mk_pt_BR=%C3%85M%C3%85%C5%BD%C3%95%C3%91&keywords=$isbn&_encoding=UTF8&tag=wwwbiblio1com-20&linkCode=ur2&linkId=66cc781dc445f7aff0f3cb1ed14c3c29&camp=1789&creative=9325";
	}

	private function getSelineURL(string $urlIdentifier)
	{
		return "https://www.livrariaseline.com.br/produtos/$urlIdentifier";
	}
}
