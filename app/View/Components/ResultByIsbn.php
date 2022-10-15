<?php

namespace App\View\Components;

use Illuminate\View\Component;

use \stdClass;

class ResultByIsbn extends Component
{
	public stdClass $book;
	public array $links;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(stdClass $book, array $links)
	{
		$this->book = $book;
		$this->links = $links;
	}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
			return view('components.result-by-isbn', [
				"isbn13" => $this->book->isbn13,
				"isbn10" => $this->book->isbn10,
				"title" => $this->book->title,
				"author" => $this->book->author,
				"publisher" => $this->book->publisher,
				"thumbnail" => $this->book->thumbnail,
				"description" => $this->book->description,
				"links" => $this->links,
			]);
    }
}
