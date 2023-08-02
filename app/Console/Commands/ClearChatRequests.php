<?php

namespace App\Console\Commands;

use App\Models\ChatRequestUser;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearChatRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'requests:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear outdated requests to chat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = ChatRequestUser::where(
            'created_at',
            '<',
            (new Carbon())->modify('-1 month')->format('Y-m-d H:i:s')
        )->delete();

        $this->info("{$deleted} rows were deleted.");
    }
}
