<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteStalePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:delete-stale';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete posts that are older than 7 days and have not been updated';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stalePosts = Order::where('updated_at', '<', Carbon::now()->subDays(7))->get();

        foreach ($stalePosts as $post) {
            $post->delete();
        }

        $this->info('Stale posts deleted successfully.');
    }
}
