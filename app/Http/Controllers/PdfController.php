<?php

namespace App\Http\Controllers;

use App\Services\PdfService;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use PDF;


/**
 * Class to manage the generation of PDF files
 *
 * @author Eliezer Alves
 * @since 23/2021
 *
 */
class PdfController extends Controller
{
    public function __construct(PdfService $service)
    {
        parent::__construct($service);
    }


    /**
     * Returns the pdf link of the specified contract
     *
     * @param int $idProposta
     * @return \Illuminate\View\View
     */
    public function linkContratoPj($idProposta)
    {
        Log::channel('teste')->info('Renovando Token Sicred');
        return route('pdf.contrato-pj.show', Crypt::encryptString($idProposta));
    }

    /**
     * Displays pdf of PJ client contracts
     *
     * @param int $hash
     * @return \Illuminate\View\View
     */
    public function contratoPj($hash)
    {
        try {
            $idProposta = Crypt::decryptString($hash);
        } catch (DecryptException $e) {
            abort(404);
        }

        $dadosProposta = $this->service->contratoPj($idProposta);

        PDF::SetTitle($dadosProposta['contrato']);
        PDF::AddPage();
        PDF::writeHTML(view('pdf.ccb-pj', $dadosProposta), true, false, true, false, '');
        PDF::Output($dadosProposta['contrato'].'_'.date('Y-m-d').'.pdf');
        exit();
    }

    /**
     * Displays pdf of PJ client contracts
     *
     * @param int $hash
     * @return \Illuminate\View\View
     */
    public function contratoPjInterno($hash)
    {
        try {
            $idProposta = base64_decode(str_replace('_', '=',$hash));
        } catch (Exception $e) {
            abort(404);
        }
        $dadosProposta = $this->service->contratoPj($idProposta);

        PDF::SetTitle($dadosProposta['contrato']);
        PDF::AddPage();
        PDF::writeHTML(view('pdf.ccb-pj', $dadosProposta), true, false, true, false, '');
        PDF::Output($dadosProposta['contrato'].'_'.date('Y-m-d').'.pdf');
        exit();
    }

    /**
     * Routine to generate PDF files from contracts
     *
     * @param int $request
     * @return \Illuminate\View\View
     */
    public function rotinaGerarPdf($hash)
    {
        try {
            $idProposta = base64_decode(str_replace('_', '=',$hash));
        } catch (Exception $e) {
            abort(404);
        }

        return $this->service->ccbPj($idProposta);
    }

}
