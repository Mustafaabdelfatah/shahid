<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DatePackageProduct;
use Carbon\Carbon;
class PackageDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:checkData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current timestamp
        $currentTimestamp = Carbon::now();

        // Query DatePackageProduct where end_date is less than or equal to the current timestamp
        $products = DatePackageProduct::where('end_date', '<=', $currentTimestamp)->active(1)->get();

        foreach ($products as $product) {
            // Update state to 0
            $product->update(['status' => 0]);
        }

        $this->info('End dates checked and states updated successfully.');
    }

}
