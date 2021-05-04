@extends('assinatura-contrato.index')
@section('content-pdf-contrato')
<iframe src="{{ $pdfContrato }}#view=FitH" class="h-screen my-4 p-4 bg-white w-full shadow-sm rounded-md"></iframe>
@endsection
