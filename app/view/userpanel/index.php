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
    <div class="col-lg-2">
      <div class="userpanel-menu">
        <ul>
          <li><a href="#profil"></a>Profil</li>
          <li><a href="#editp"></a>Modifier mes informations</li>
          <li><a href="#"></a>Modifier ma signature</li>
          <li><a href="#"></a>Gérer mes notifications</li>
        </ul>
      </div>
    </div>
    <div class="col-lg-10">
      <div id="profil" class="userpanel-content">
        <h3>Page principal</h3>
        <p>Bienvenue sur le panneau de contrôle de l’utilisateur. Dans ce dernier, vous pouvez consulter et mettre à jour votre profil, vos préférences.</p>
      </div>
      <div id="editp" class="userpanel-content">
        <span><b>Nom d'utilisateur: </b><?=$res["username"]?></span>
        <span><b>Adresse e-mail: </b><?=$res["email"]?></span>
        <span><b>Adresse IP</b></span>
        <form class="" action="" method="post">
          <input type="password" name="password" value="">
          <input type="password" name="confirm_password" value="">
          <input type="date" name="birthday" value="<?=$res["birthday"]?>">
          <input type="text" name="firstname" value="<?=$res["firstname"]?>">
          <input type="text" name="lastname" value="<?=$res["lastname"]?>">
        </form>
      </div>
    </div>
  </div>
  <?php include(FOOTER); ?>
</body>
</html>
