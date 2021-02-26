<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\ConfiguracaoSicred;
use App\Models\UrlSicred;

class ConfiguracaoSicredSeeder extends Seeder
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
            $objConfiguracaoSicred = ConfiguracaoSicred::Factory()->make();
            $objUrlSicred = UrlSicred::Factory()->make();

            $urlSicred = UrlSicred::create($objUrlSicred->toArray());
            $objConfiguracaoSicred->id_url_sicred = $urlSicred->id_url_sicred;

            ConfiguracaoSicred::create($objConfiguracaoSicred->toArray());
            DB::commit();
        } catch (Exception $e) {
            DB::rolback();
        }
    }
}
