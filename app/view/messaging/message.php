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
    <div class="col-sm-12 col-md-8 messaging_messages_space"> 
      
      <div class="write-space">
        <form method="POST" action="#" class="">
          <input type="text" name="message" placeholder="Tapez votre message: ">
          <input type="submit" name="envoyer" placeholder="Tapez votre message: ">
        </form>
      </div>   
    </div>
    <!-- END MESSAGES SPACE-->
    <!-- USERS CONNECTED SPACE-->
    <div class="col-md-4 messaging_connected_users"> 
      <h2>Utilisateurs connectés</h2>
    </div>
    <!-- END USERS CONNECTED SPACE-->
  </div>
  <script src="../<?=JS?>main.js"></script>
  <?php include(FOOTER); ?>
</body>
</html>
