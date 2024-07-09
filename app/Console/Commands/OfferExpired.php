<?php

namespace App\Console\Commands;

use App\Models\ProductDiscount;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OfferExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:offer-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Offer Expired when special_price_end finishes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $offers = ProductDiscount::where('special_price_end', '<', Carbon::now())->get();
        foreach($offers as $offer){
                $offer->delete();
        }

    }
}
