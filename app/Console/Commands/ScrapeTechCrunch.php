<?php

namespace App\Console\Commands;

use App\Services\ScraperService;
use Illuminate\Console\Command;

class ScrapeTechCrunch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:techCrunch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scraping TechCrunch latest 10 blog posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ScraperService $scraperService
     * @return void
     */
    public function handle(ScraperService $scraperService)
    {
        $scraperService->scrapTechCrunch(config('goutte.tech_crunch_url'));
    }
}
