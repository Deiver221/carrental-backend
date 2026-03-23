<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CompleteExpiredReservations extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:complete-expired-reservations';

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
    $today = Carbon::today();

    $updated = Reservation::where('status', Reservation::STATUS_CONFIRMED)
        ->where('end_date', '<=', $today)
        ->update([
            'status' => Reservation::STATUS_COMPLETED
        ]);

    $this->info("Reservations completed: " . $updated);

    return Command::SUCCESS;
}
}
