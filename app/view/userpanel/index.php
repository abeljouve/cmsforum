<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include(META); ?>
  <link rel="icon" href="<?=FAVICON?>">
  <title>CMS FORUM</title>
  <link href="../<?=CSS?>bootstrap.min.css" rel="stylesheet">
  <link href="../<?=CSS?>font-awesome.min.css" rel="stylesheet">
  <link href="../<?=CSS?>main.css" rel="stylesheet">
  <link href="../<?=CSS?>userpanel.css" rel="stylesheet">
  <script src=../"<?=JS?>jquery.min.js"></script>
  <script src="../<?=JS?>bootstrap.min.js"></script>
</head>
<body>
  <?Php include(HEADER); ?>
  <div class="row">
    <div class="col-lg-3">
      <div class="userpanel-menu">
        <ul>
          <li><a href="#profil">Profil</a></li>
          <li><a href="#editp">Modifier mes informations</a></li>
          <li><a href="#edits">Modifier ma signature</a></li>
          <li><a href="#editn">Gérer mes notifications</a></li>
        </ul>
      </div>
    </div>
    <div class="col-lg-9">
      <div id="profil" class="userpanel-content">
        <h3>Page principal</h3>
        <p>Bienvenue sur le panneau de contrôle de l’utilisateur. Dans ce dernier, vous pouvez consulter et mettre à jour votre profil, vos préférences. Pour changer votre image de profile, inscrivez vous sur <a href="https://gravatar.com">gravatar.com</a> pour associer une image à votre adresse email.</p>
      </div>
      <div id="editp" class="userpanel-content">
        <img src="<?=$_SESSION["profile_img"]?>"><br>
        <span><b>Nom d'utilisateur:&nbsp;</b><?=$res0["username"]?></span><br>
        <span><b>Adresse e-mail:&nbsp;</b><?=$res0["email"]?></span><br>
        <span><b>Adresse IP:&nbsp;</b></span><?=$res0["ip"]?><br>&nbsp;<br>
        <form class="" action="" method="post">
          <label for="password">Changer votre mot de passe</label><br>
          <input id="password" type="password" name="password" placeholder="******************"><br>
          <label for="confirm_password">Cronfirmer nouveau mot de passe</label><br>
          <input id="confirm_password" type="password" name="confirm_password"><br>
          <label for="birthday">Date de naissance</label><br>
          <input id="birthday" type="date" name="birthday" value="<?=$res["birthday"]?>"><br>
          <label for="firstname">Prénom</label><br>
          <input id="firstname" type="text" name="firstname" value="<?=$res["firstname"]?>"><br>
          <label for="lastname">Nom</label><br>
          <input id="lastname" type="text" name="lastname" value="<?=$res["lastname"]?>"><br>
          <input type="submit" name="" value="Modifier">
        </form>
      </div>
    </div>
  </div>
  <?php include(FOOTER); ?>
</body>
</html>
