<?php

namespace Database\Seeders;


use App\Models\Cliente;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
    	try{
    		DB::beginTransaction();
    		$obj_cliente = Cliente::Factory()->create();
	        DB::commit();
	    } catch (Exception $e){
	    	DB::rolback();
	    }
    }
}
