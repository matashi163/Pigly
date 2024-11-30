<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WeightLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        for ($i = 0; $i < 35; $i++) {
            WeightLog::factory()->create([
                'date' => Carbon::now()->subDay(35)->startOfDay()->copy()->addDays($i),
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
