<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Cameras;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the database from the csv file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $file = Storage::get('cameras.csv');
      $cams = array_slice(explode("\n", $file), 1);
      foreach($cams as $cam) {
        $cam = explode(',', $cam);
        Cameras::create([
          'ip' => $cam[0],
          'port' => $cam[1],
          'count' => $cam[3],
          'source' => $cam[4],
          'city' => $cam[5],
          'country' => $cam[6],
          'code' => $cam[7],
          'lat' => $cam[9],
          'long' => $cam[8] 
        ]);
      }

      return 1;
    }
}
