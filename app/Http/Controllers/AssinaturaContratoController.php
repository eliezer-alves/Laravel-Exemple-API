<?php

namespace App\Http\Controllers;

/**
 * Class responsible for managing the
 * signing of Ágil contracts
 *
 * @author Eliezer Alves
 * @since 28/04/2021
 *
 */
class AssinaturaContratoController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Show page to sign the first part of the contract.
     *
     * @since 28/04/2021
     *
     * @param  int  $idProposta
     * @return \Illuminate\Http\Response
     */
    public function aceite1($idProposta)
    {
        dd($idProposta);
    }

    /**
     * Show page to sign the second part of the contract.
     *
     * @since 28/04/2021
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function aceite2()
    {

    }
}
