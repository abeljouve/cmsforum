<?php
$message = array('success' => array(), 'errors' => array());
$progress = true;
if (isset($_POST["username"]) && isset($_POST["password"])) {
  if (isset($_POST["confirmation"]) && isset($_POST["email"])) {
    # Inscription
    if (strpos($_POST["username"], ' ')>0) {
      $progress=false;
      array_push($message["errors"],"Le nom d'utilisateur ne doit pas contenir d'espaces.");
    }
    if (strlen($_POST["password"])<6) {
      $progress=false;
      array_push($message["errors"],"Le mot de passe doit comprendre au moins 6 caractères.");
    }
    if (!($_POST["password"]==$_POST["confirmation"])) {
      $progress=false;
      array_push($message["errors"],"Les deux mots de passes doivent êtres identiques.");
    }
    # Vérification du format de l'adresse email et on regarde que le domaine possède un enregistrement dns MX.
    if (!(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && checkdnsrr(ltrim(stristr($_POST["email"], '@'), '@'), 'MX'))) {
      $progress=false;
      array_push($message["errors"],"L'adresse email saisie n'existe pas.");
    }
    $stmt = $PDOStatement->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount()>0) {
      $progress=false;
      array_push($message["errors"],"Le nom d'utilisateur saisie est déjà utilisé.");
    }
    $stmt = $PDOStatement->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount()>0) {
      $progress=false;
      array_push($message["errors"],"L'adresse email saisie est déjà utilisé.");
    }
    if ($progress) {
      $confirmcode = "";
      $x = "a1b2c3d4e5f6g7h8i9j0klmnpqrstuvwxy";
      srand((double)microtime()*1000000);
      for($i=0; $i<5; $i++) {
        $confirmcode .= $x[rand()%strlen($x)];
      }
      $emailmsg = 'Bienvenue sur CMSFORUM,
      Voici votre code de confirmation:'.strtoupper($confirmcode).'
      ---------------
      Ceci est un email automatique, merci de ne pas y répondre.';

      mail($_POST["email"], "Confirmer votre adresse email", $emailmsg, "From: noreply@abeljouve.fr");
      array_push($message["success"], "Un email de confirmation vous à été envoyé.");

      $_SESSION["temp_username"]=$_POST["username"];
      $_SESSION["temp_password"]=$_POST["password"];
      $_SESSION["temp_email"]=$_POST["email"];
      $_SESSION["temp_confirm_code"]=strtoupper($confirmcode);
    }

  }else {
    $stmt = $PDOStatement->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount()>0) {
      $res = $stmt->fetchAll()[0];
      if (md5($_POST["password"])==$res["password"]) {
        $_SESSION["id"]=$res["id"];
        $_SESSION["username"]=$res["username"];
        $_SESSION["email"]=$res["email"];
      }
    }else {
      array_push($message["errors"],"Le nom d'utilisateur saisie est déjà utilisé.");
    }
  }
}
 ?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 header">
      <img src="../<?=IMG."/banner.jpg"?>">
    </div>
    <div class="col-lg-12 menu">
      <nav class="navbar navbar-default">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="../">Accueil</a></li>
            <li><a href="/index.php/forum">Forum</a></li>
            <li><a href="/index.php/chatbox">ChatBox</a></li>
            <li><a href="/index.php/galerie">Galerie</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="<?=isset($_SESSION['id'])?"connected":"disconnected"?>">
              <?php if(isset($_SESSION['id'])){ ?>
              <a class="dropdown-toggle logged" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://s.gravatar.com/avatar/9694fdb1bee111261392c06a0894b05a?s=80"></a>
              <ul class="dropdown-menu">
                <li><a href="#">...</a></li>
                <li><a href="#">.....</a></li>
                <li><a href="/index.php/logout">Deconexion</a></li>
              </ul>
              <?php }else{ ?>
              <a class="unlogged" data-toggle="modal" data-target=".login-modal">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
              </a>
              <?php } ?>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="modal fade login-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="custom-modal">
        <div class="modal-contol">
          <span>Se connecter</span><a data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
        <div class="modal-container">
          <form class="modal-form" action="#" method="post">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" value="<?=isset($_POST['username'])?$_POST['username']:''?>" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" value="<?=isset($_POST['password'])?$_POST['password']:''?>" required>
            <input class="button" type="submit" value="Se connecter"><input class="button" type="button" id="register" value="S'inscrire">
          </form>
          <p><?php
            if (!empty($message["errors"]) && !isset($_POST["email"])) {
              echo "<script type='text/javascript'>$('.login-modal').modal('show');</script>";
              foreach ($message["errors"] as $value) {
                echo '<div class="cutom-alert-danger">'.$value.'</div>';
              }
            }
           ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade register-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="custom-modal">
        <div class="modal-contol">
          <span>Inscription</span><a data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
        <div class="modal-container">
          <form class="modal-form" action="#" method="post">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" value="<?=isset($_POST['username'])?$_POST['username']:''?>" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" value="<?=isset($_POST['password'])?$_POST['password']:''?>" required>
            <label for="confirmation">Mot de passe</label>
            <input type="password" name="confirmation" value="<?=isset($_POST['confirmation'])?$_POST['confirmation']:''?>" required>
            <label for="email">Adresse email</label>
            <input type="email" name="email" value="<?=isset($_POST['email'])?$_POST['email']:''?>" required>
            <input class="button" type="submit" value="S'inscrire">
          </form>
          <p><?php
            if (!empty($message["errors"]) && isset($_POST["email"])) {
              echo "<script type='text/javascript'>$('.register-modal').modal('show');</script>";
              foreach ($message["errors"] as $value) {
                echo '<div class="cutom-alert-danger">'.$value.'</div>';
              }
            }
           ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade confirm-email-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="custom-modal">
        <div class="modal-contol">
          <span>Vérification de l'adresse email</span><a data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
        <div class="modal-container">
          <p>Un email vous à été envoyé, il contient un code que vous devez saisir ci-dessous pour finaliser votre inscription. Vérifiez que le mail ne soit pas dans les indésirables.</p>
          <form class="modal-form" action="#" method="post">
            <label for="confirm-code">Code de confirmation</label>
            <input type="text" name="confirm-code" required>
            <input class="button" type="submit" value="Terminer l'inscription">
          </form>
          <form class="modal-form" action="#" method="post">
            <input type="text" name="cancel-registration" hidden>
            <input class="button" type="submit" value="Annuler l'inscription">
          </form>
            <?php
            if (isset($_POST["cancel-registration"])) {
              unset($_SESSION["temp_username"]);
              unset($_SESSION["temp_password"]);
              unset($_SESSION["temp_email"]);
              unset($_SESSION["temp_confirm_code"]);
              header("Location: ".$page);
            }
            if (isset($_POST["confirm-code"])) {
              if (strtoupper($_POST["confirm-code"])==$_SESSION["temp_confirm_code"]) {
                $stmt = $PDOStatement->prepare("INSERT INTO user (username, password, email, registration_date, last_login_date, ip) VALUES (:username, :password, :email, :registration_date, :last_login_date, :ip)");
                $stmt->bindParam(":username", $_SESSION["temp_username"], PDO::PARAM_STR);
                $stmt->bindParam(":password", md5($_SESSION["temp_password"]), PDO::PARAM_STR);
                $stmt->bindParam(":email", $_SESSION["temp_email"], PDO::PARAM_STR);
                $stmt->bindParam(":registration_date", date('Y-m-d H:i:s'), PDO::PARAM_STR);
                $stmt->bindParam(":last_login_date", date('Y-m-d H:i:s'), PDO::PARAM_STR);
                $stmt->bindParam(":ip", $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                if ($stmt->execute()) {
                  unset($_SESSION["temp_confirm_code"]);
                  $stmt = $PDOStatement->prepare("SELECT * FROM user WHERE username=:username");
                  $stmt->bindParam(":username", $_SESSION["temp_username"], PDO::PARAM_STR);
                  $stmt->execute();
                  $res = $stmt->fetchAll()[0];
                  $_SESSION["id"]=$res["id"];
                  $_SESSION["username"]=$res["username"];
                  $_SESSION["email"]=$res["email"];
                  header("Location: ".$page);
                }else {
                  array_push($message["errors"],"Une erreur est survenue lors de la creation du compte.<br>Error SQLSTATE[".$stmt->errorInfo()[0]."][".$stmt->errorInfo()[1]."]: ".$stmt->errorInfo()[2]);
                }
              }else {
                array_push($message["errors"],"Le code saisie est incorrecte.");
              }
            }
            if (isset($_SESSION["temp_confirm_code"]) && $_SESSION["temp_confirm_code"]!="") {
              echo "<script type='text/javascript'>$('.confirm-email-modal').modal('show');</script>";
               foreach ($message["errors"] as $value) {
                 echo '<div class="cutom-alert-danger">'.$value.'</div>';
               }
            }
            ?>
        </div>
      </div>
    </div>
  </div>
