<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ResultListItem extends Component
{
	public string | null $isbn13;
	public string | null $isbn10;
	public string | null $title;
	public string | null $author;
	public string | null $publisher;
	public string | null $thumbnail;
	public string | null $description;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(
		string | null $isbn13,	
		string | null $isbn10,
		string | null $title,
		string | null $author,
		string | null $publisher,
		string | null $thumbnail,
		string | null $description
	)
	{
		$this->isbn13 = $isbn13;
		$this->isbn10 = $isbn10;
		$this->title = $title;
		$this->author = $author;
		$this->publisher = $publisher;
		$this->thumbnail = $thumbnail;
		$this->description = $description;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.result-list-item', [
			"isbn13" => $this->isbn13,
			"isbn10" => $this->isbn10,
			"title" => $this->title,
			"author" => $this->author,
			"publisher" => $this->publisher,
			"thumbnail" => $this->thumbnail,
			"description" => $this->description,
		]);
	}
}
