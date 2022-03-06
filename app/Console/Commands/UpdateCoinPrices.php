<?php

namespace App\Console\Commands;

use App\Models\Coin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateCoinPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coins:price';

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

        $perPage = 100;
        $page = 1;
        $url = "https://api.nomics.com/v1/currencies/ticker?key=".$api_key."&interval=1d&per-page=".$perPage."&page=".$page."&status=active";
        $json = Http::get($url)->throw()->json();
        $maxPages = 10;

        while(sizeof($json)) {
            print "\nPage: " . $page;

            foreach($json as $c) {
                $coin = Coin::firstOrCreate(['remote_id' => $c['id']]);

                // flatten the 
                if (isset($c['1d'])) {
                    foreach($c['1d'] as $key => $item) {
                        $c['oneday_'.$key] = $item;
                    }
                }

                $coin->fill($c);
                $coin->save();
            }
    
            if ($page >= $maxPages) {
                break;
            }

            sleep(1);
            $page = $page + 1;
            $url = "https://api.nomics.com/v1/currencies/ticker?key=".$api_key."&interval=1d&per-page=".$perPage."&page=".$page."&status=active";
            $json = Http::get($url)->throw()->json();
        }
        
        return 0;
    }
}
