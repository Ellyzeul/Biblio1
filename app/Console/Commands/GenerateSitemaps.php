<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\SitemapURLController;

class GenerateSitemaps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera sitemaps com todas as páginas de resultados de pesquisa por ISBN';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = new SitemapURLController();
        $controller->create();
        
        $this->info("Sitemaps gerados!!");
    }
}
