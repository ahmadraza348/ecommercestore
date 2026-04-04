<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ClearAbandonedCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-abandoned-carts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete abandoned carts older than 2 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expirationDate = Carbon::now()->subHours(24);

       $expiredCarts = Cart::get();
       $count = $expiredCarts->count();

       foreach ($expiredCarts as $cart) {
            $cart->delete();
        }
        $this->info("Successfully deleted {$count} abandoned carts.");
   
    }
}
