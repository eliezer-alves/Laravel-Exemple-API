<?php

namespace Database\Seeders;

use App\Models\ModeloSicred;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeloSicredSeeder extends Seeder
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
            $objModeloSicred = ModeloSicred::Factory()->create();
            DB::commit();
        } catch (Exception $e) {
            DB::rolback();
        }
    }
}
