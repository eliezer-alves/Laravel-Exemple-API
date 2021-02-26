<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UrlSicred;

class UrlSicredSeeder extends Seeder
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
            $objUrlSicred = UrlSicred::Factory()->create();
            DB::commit();
        } catch (Exception $e) {
            DB::rolback();
        }
    }
}
