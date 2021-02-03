
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form" id="form_login" action="http://localhost:8082/login/auth" method="POST">
              @csrf              
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
    </div>
  </body>
