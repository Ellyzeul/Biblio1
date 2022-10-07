<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Quote extends Component
{
    public string $quote;
    public string $quoteAuthor;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($quote, $quoteAuthor)
    {
        $this->quote = $quote;
        $this->quoteAuthor = $quoteAuthor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.quote', [
            "quote" => $this->quote,
            "quote_author" => $this->quoteAuthor
        ]);
    }
}
