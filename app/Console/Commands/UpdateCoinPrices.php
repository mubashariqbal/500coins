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
        $list = Coin::whereNull('rank')
            ->orderBy('id', 'asc')->paginate($perPage, ['*'], $pageName = 'page', $page);
        $pages = $list->lastPage();
        print "\nPages: " . $pages;

        $offset = 0;
        while($page <= $pages) {
            print "\nPage: " . $page;
            $ids = [];
            foreach($list as $coin) {
                // print ".";
                $ids[] = $coin->remote_id;
            }

            $url = "https://api.nomics.com/v1/currencies/ticker?key=".$api_key."&ids=".implode(',', $ids)."&interval=1d&per-page=100&page=1&status=active";
            $json = Http::get($url)->throw()->json();

            if ($json) {
                foreach($json as $c) {
                    $coin = Coin::firstOrCreate(['remote_id' => $c['id']]);
                    $coin->fill($c);
                    $coin->save();
                }
            } else {
                print " NO DATA " . $page;
            }
    
            $page = $page + 1;
            $list = Coin::orderBy('id', 'asc')->paginate($perPage, ['*'], $pageName = 'page', $page);
            sleep(1);
        }
        
        return 0;
    }
}
