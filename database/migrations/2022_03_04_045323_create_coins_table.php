<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();

            $table->string('remote_id')->index();
            $table->string('status')->nullable();
            $table->unsignedDecimal('price', 40, 10)->nullable();
            $table->datetime('price_date')->nullable();
            $table->datetime('price_timestamp')->nullable();
            $table->string('symbol')->nullable();
            $table->unsignedDecimal('circulating_supply', 40, 10)->nullable();
            $table->unsignedDecimal('max_supply', 40, 10)->nullable();
            $table->string('name')->nullable();
            $table->string('logo_url')->nullable();
            $table->unsignedDecimal('market_cap', 40, 10)->nullable();
            $table->unsignedDecimal('market_cap_dominance', 40, 10)->nullable();
            $table->unsignedDecimal('transparent_market_cap', 40, 10)->nullable();
            $table->unsignedInteger('num_exchanges')->nullable();
            $table->unsignedInteger('num_pairs')->nullable();
            $table->unsignedInteger('num_pairs_unmapped')->nullable();
            $table->datetime('first_candle')->nullable();
            $table->datetime('first_trade')->nullable();
            $table->datetime('first_order_book')->nullable();
            $table->datetime('first_priced_at')->nullable();
            $table->unsignedInteger('rank')->nullable();
            $table->bigInteger('rank_delta')->nullable();
            $table->unsignedDecimal('high', 40, 10)->nullable();
            $table->datetime('high_timestamp')->nullable();

            $table->decimal('oneday_price_change', 40, 10)->nullable();
            $table->decimal('oneday_price_change_pct', 40, 10)->nullable();
            $table->unsignedDecimal('oneday_volume', 40, 10)->nullable();
            $table->decimal('oneday_volume_change', 40, 10)->nullable();
            $table->decimal('oneday_volume_change_pct', 40, 10)->nullable();
            $table->decimal('oneday_market_cap_change', 40, 10)->nullable();
            $table->decimal('oneday_market_cap_change_pct', 40, 10)->nullable();
            $table->decimal('oneday_transparent_market_cap_change', 40, 10)->nullable();
            $table->decimal('oneday_transparent_market_cap_change_pct', 40, 10)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
