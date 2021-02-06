@extends('master')

@section('title', 'Proposta')

<!--
@section('sidebar')
@endsection
 -->
 
<!--
@section('topbar')
@endsection
 -->
@section('content')
<div class="row" style="width: 100%!important">
  <div class="col-sm-12 col-sm-offset-12 col-md-12 col-md-offset-12 col-lg-12 col-lg-offset-12 form-wizard">

    <!-- Form Wizard -->
    <form role="form" id="form_proposta_cnpj" class="form_proposta" action="" method="POST" enctype="multipart/form-data">
      <!-- 
      <h3>Sign Up Office Employee Account</h3>
      <p>Fill all form field to go next step</p>
       -->
      <!-- Form progress -->
      <div class="form-wizard-steps form-wizard-tolal-steps-4">
        <div class="form-wizard-progress">
          <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4" style="width: 12.25%;"></div>
        </div>
        <!-- Step 1 -->
        <div class="form-wizard-step active">
          <div class="form-wizard-step-icon"><i class="fa fa-money" aria-hidden="true"></i></div>
          <p>Simulação</p>
        </div>
        <!-- Step 1 -->

        <!-- Step 2 -->
        <div class="form-wizard-step">
          <div class="form-wizard-step-icon"><i class="fa fa-building-o" aria-hidden="true"></i></div>
          <p>Empresa</p>
        </div>
        <!-- Step 2 -->

        <!-- Step 3 -->
        <div class="form-wizard-step">
          <div class="form-wizard-step-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
          <p>Representante Legal</p>
        </div>
        <!-- Step 3 -->

        <!-- Step 4 -->
        <div class="form-wizard-step">
          <div class="form-wizard-step-icon"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
          <p>Concluir</p>
        </div>
        <!-- Step 4 -->
      </div>
      <br>
      <!-- Form progress -->
      @include('solicitacao.steps.step_1')
      @include('solicitacao.steps.step_2')
      @include('solicitacao.steps.step_3')
      @include('solicitacao.steps.step_4')
      <!-- Form progress -->
    </form>
    <!-- Form Wizard -->
  </div>
</div>
@endsection
