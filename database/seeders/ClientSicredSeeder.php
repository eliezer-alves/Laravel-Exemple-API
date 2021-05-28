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
            $clientSicred = ClientSicred::create($objClientSicred->toArray());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
