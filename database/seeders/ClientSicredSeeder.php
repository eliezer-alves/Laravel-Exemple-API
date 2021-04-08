<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\ClientSicred;
use App\Models\UrlSicred;

class ClientSicredSeeder extends Seeder
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
            $objClientSicred = ClientSicred::Factory()->make();
            $objUrlSicred = UrlSicred::Factory()->make();

            $clientSicred = ClientSicred::create($objClientSicred->toArray());
            $objUrlSicred->id_client_sicred = $clientSicred->id_client_sicred;
            $urlSicred = UrlSicred::create($objUrlSicred->toArray());

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
