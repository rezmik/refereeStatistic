<h1 class="h1class">RefereeStatistic.pl</h1>
<h2>Check yourself!</h2>

<!--<button id="loginButton" data-toogle="modal" data-target="#myModal">Logowanie</button>-->

<button id="loginButton" data-toggle="modal" data-target="#myModal">Logowanie</button>

<!--Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog login">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Zaloguj się!</h4>
      </div>
      <div class="modal-body">
        <!--<div id="login">-->
          <form action="login.php" method="post">

            <input type="text" name="login" placeholder="Login"/>
            <input type="password" name="haslo" placeholder="Hasło"/>
            <input type="submit" value="Zaloguj się" />

          </form>

          <a href="#">Zapomniałeś hasła?</a>


      </div>
    </div>
  </div>
</div>

<button id="registerButton">Rejestracja</button>
