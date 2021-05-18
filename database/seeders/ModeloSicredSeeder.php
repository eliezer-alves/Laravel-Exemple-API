<?php

namespace Database\Seeders;

use App\Models\ModeloSicred;
use App\Models\UrlSicred;
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
            $modeloSicred = ModeloSicred::Factory()->create();
            $modeloSicred->urls()->attach(UrlSicred::all());
            DB::commit();
        } catch (Exception $e) {
            DB::rolback();
        }
    }
}
