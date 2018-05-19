<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

</div>
<body>
  <div align="center">
    <div id="login-button">
        <img src="https://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png">  
    </div>
    <div id="register-button">
        <img src="https://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png">  
    </div>
  </div>

<!--Login-->

  <div id="container" class="login">
    <h1>Log In</h1>
    <span id="close-btn-login">
      <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
    </span>

    <form action="processarLogin.php" method="post">
      <input type="email" name="email" placeholder="E-mail">
      <input type="password" name="pass" placeholder="Password">
      <input type="submit" value="Login">
      <div id="remember-container">
        <a href="forgetPassword.php"><span id="forgotten">Forgotten password</span></a>
      </div>
    </form>
  </div>

<!--REGISTO-->

  <div id="container" class="register">
    <h1>Registe-se</h1>
    <span id="close-btn-login">
      <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
    </span>

    <form action="processarRegisto.php" method="post" id="formRegister">
      <input type="text" name="nome" id="nome" placeholder="Nome">
      <input type="date" name="dataNascimento" id="dataNascimento" placeholder="Data Nascimento">
      <input type="text" name="morada" placeholder="Morada" id="morada">
      <input type="number" name="telefone" placeholder="Telemovel" id="telefone">
      <input type="text" name="email" placeholder="E-mail" id="email">
      <input type="password" name="password" placeholder="Password" id="password">
      <input type="password" name="passConfirm" placeholder="Confirme Password" id="confirmPassword">
      <input type="button" value="Register" onclick="verificarRegisto()">
    </form>
  </div>

  <script src="js/login.js"></script>
  <script>
    function verificarRegisto(){
      var nome = document.getElementById('nome').value;
      var dataNascimento = document.getElementById("dataNascimento").value;
      var morada = document.getElementById('morada').value;
      var telefone = document.getElementById("telefone").value;
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      
      var confirm = 0;
      var date = new Date(dataNascimento);
      var year = date.getFullYear();
      if(year < new Date().getFullYear())
        confirm = 1;


      if(nome !== "" && confirm === 1 && morada !== "" && telefone !== "" && email !== "" && password === confirmPassword){
        $(".error").removeClass("error");
        var formRegister = document.getElementById("formRegister");
        formRegister.submit();
      }
      else{
        $(".error").removeClass("error");
        if(nome === "")
          $("#nome").addClass("error");
        if(dataNascimento === "")
          $("#dataNascimento").addClass("error");

        var date = new Date(dataNascimento);
        var year = date.getFullYear();
        if(year < new Date().getFullYear())
          $("#dataNascimento").addClass("error");


        if(morada === "")
          $("#morada").addClass("error");
        if(telefone === "")
          $("#telefone").addClass("error");
        if(email === "")
          $("#email").addClass("error");
        if(password === "")
          $("#password").addClass("error");
        if(confirmPassword === "")
          $("#confirmPassword").addClass("error");

        if(password !== "" && confirmPassword !== ""){
          if(password !== confirmPassword){
            $("#password, #confirmPassword").addClass("error");
            alert("Password nao sao iguais!");
          }
        }
        
      }
    }
  </script>

</body>

</html>
