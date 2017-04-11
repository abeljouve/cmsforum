<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include(META); ?>
  <link rel="icon" href="<?=FAVICON?>">
  <title>CMS FORUM</title>
  <link href="../<?=CSS?>bootstrap.min.css" rel="stylesheet">
  <link href="../<?=CSS?>font-awesome.min.css" rel="stylesheet">
  <link href="../<?=CSS?>main.css" rel="stylesheet">
  <link href="../<?=CSS?>messaging.css" rel="stylesheet">
  <script src="../<?=JS?>jquery.min.js"></script>
  <script src="../<?=JS?>bootstrap.min.js"></script>
</head>
<body>
  <?Php include(HEADER); ?>
  <div class="row">
    <!-- MESSAGES SPACE-->
    <div class="col-lg-12">
      <div class="col-sm-8 col-lg-8 col-md-8 messaging_messages_space"> 
      <div id="vertic-bar"></div>
      <div id="write-space">
        <div id="horiz-bar"></div>
        <form method="POST" action="#" class="">
          <input type="text" class="stroke_zone" name="message" maxlenght="160" placeholder="Tapez votre message: ">
          <input type="submit" class="envoyer" name="envoyer" placeholder="Tapez votre message: ">
        </form>
      </div>   
    </div>
    <!-- END MESSAGES SPACE-->
    <!-- USERS CONNECTED SPACE-->
    <div class="col-md-4 messaging_connected_users"> 
      <p style="font-size: 18px; margin-top: 20px; color: #333333;">Utilisateurs connectés</p>
    </div>
    <!-- END USERS CONNECTED SPACE-->
    </div>
  </div>
  <script src="../<?=JS?>main.js"></script>
  <?php include(FOOTER); ?>
</body>
</html>
