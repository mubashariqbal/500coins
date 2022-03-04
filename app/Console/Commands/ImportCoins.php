<?php

namespace App\Console\Commands;

use App\Models\Coin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportCoins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coins:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $api_key = config('services.nomics.key');

        $url = "https://api.nomics.com/v1/prices?key=".$api_key."&format=json";

        dd($url);
        $json = Http::get($url)->json();
        
        foreach($json as $index => $coin) {
            // print ".";
            Coin::firstOrCreate(['remote_id' => $coin['currency']]);
        }

        return 0;
    }
}
