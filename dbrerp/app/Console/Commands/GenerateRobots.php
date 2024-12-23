<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateRobots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robots:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the robots';

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
     * @return int
     */
    public function handle()
    {
        $robots = new \Mguinea\Robots\Robots;

        // If on the live server
        if (app()->environment() == 'production') {
            $robots->addUserAgent('*')
                ->addDisallow('/')
                ->addUserAgent(['Googlebot', 'Yeti', 'Daum'])
                ->addAllow('/')
                ->addDisallow('/dabory/erp')
                ->addSitemap(env('APP_URL') . '/' . 'sitemap.xml');
        } else {
            // If you're on any other server, tell everyone to go away.
            $robots->addDisallow('/');
        }

        Storage::disk('erp')->put('robots.txt', $robots->generate());

        return 0;
    }
}
