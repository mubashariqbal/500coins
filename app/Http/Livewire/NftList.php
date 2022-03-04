<?php

namespace App\Http\Livewire;

use App\Models\Coin;
use Livewire\Component;

class NftList extends Component
{
    public $sort = "rank";
    public $sorts = [
        'rank'  => "Nomics Rank",
        'market_cap'  => "Market cap",
        'price'  => "Price",
        'volume'  => "One day volume",
    ];

    public function render()
    {

        $data = [];

        if ($this->sort == 'price') {
            $coins = Coin::orderBy('price', 'desc')->limit(500)->get();
        } elseif ($this->sort == 'rank') {
            $coins = Coin::whereNotNull('rank')->orderBy('rank', 'asc')->limit(500)->get();
        } elseif ($this->sort == 'volume') {
            $coins = Coin::orderBy('oneday_volume', 'desc')->limit(500)->get();
        } else {
            $coins = Coin::orderBy('market_cap', 'desc')->limit(500)->get();
        }

        $data['coins'] = $coins;

        return view('livewire.nft-list', $data);
    }


    public function sort($value)
    {
        $this->sort = $value;
    }

    public function sortChanged()
    {
    }
}
