<?php

namespace App\Services\CCB;

use App\Services\Contracts\CcbServiceInterface;

class CcbService
{
    public function pdf(CcbServiceInterface $tipoCcb)
    {
        return $tipoCcb->pdf();
    }
}
