<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

        // $expiredPosts = DB::table('posts')
        //     ->where('expire', '<', now())
        //     ->get();

        // foreach ($expiredPosts as $post) {
        //     // Delete the image file from the folder
        //     $imagePath = public_path($post->image_path);
        //     File::delete($imagePath);

        //     // Delete the post from the database
        //     DB::table('posts')
        //         ->where('id', $post->id)
        //         ->delete();
        // }

        // $this->info('Expired posts deleted successfully.');

    }
}
