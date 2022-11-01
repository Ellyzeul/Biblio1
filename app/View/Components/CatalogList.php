<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CatalogList extends Component
{
	public array $books;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(array $books)
	{
		$this->books = $books;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.catalog-list', [
			"books" => $this->books
		]);
	}
}
