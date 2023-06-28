<?php

namespace App\Console\Commands;

use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        Posts::where('expire', '<=', Carbon::now())->delete();
        $this->info('Expired posts deleted successfully.');
    }
}
