<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;

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
    protected $description = 'Delete abandoned guest carts older than 2 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cart::whereNull('user_id')
            ->where('updated_at', '<', now()->subDays(2))
            ->delete();
    }
}
