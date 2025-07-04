<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CotationRow extends Component
{
	public string $price;
	public string $idSellercentral;
	public string $sellercentral;
	public string $company;
	public string $idCompany;
	public string $link;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(
		string $price,
		string $idSellercentral,
		string $sellercentral,
		string $company,
		string $idCompany,
		string $link
	)
	{
		$this->price = $price;
		$this->idSellercentral = $idSellercentral;
		$this->sellercentral = $sellercentral;
		$this->company = $company;
		$this->idCompany = $idCompany;
		$this->link = $link;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.cotation-row');
	}
}
