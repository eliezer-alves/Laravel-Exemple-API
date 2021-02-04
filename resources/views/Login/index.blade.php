@extends('master')

@section('title', 'Login')

<!--
@section('sidebar')
@endsection
 -->

<!--
@section('topbar')
@endsection
 -->
@section('content')
  <div class="login">
    <div class="animate form">
      <section class="login_content">
        <form class="form" id="form_login" action="http://localhost:8082/login/auth" method="POST">
          @csrf
          <h1><img src="{{ url('assets/images/logoAgilVertical.png') }}" width="300px"></h1>
          <div>
            <input type="text" class="form-control" placeholder="Usuário" name="identificacao" required="" />
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Senha" name="senha" required="" />
          </div>
          <div>
            <button class="btn btn-default submit _btn_login" type="submit">Log in</button>
          </div>

          <div class="clearfix"></div>
        </form>
      </section>
    </div>      
  </div>
@endsection
