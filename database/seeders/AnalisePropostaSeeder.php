<?php

namespace Database\Seeders;

use App\Models\AnaliseProposta;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnalisePropostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            AnaliseProposta::create([]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
