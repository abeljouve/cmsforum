<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include(META); ?>
  <link rel="icon" href="<?=FAVICON?>">
  <title>CMS FORUM</title>
  <link href="../<?=CSS?>bootstrap.min.css" rel="stylesheet">
  <link href="../<?=CSS?>font-awesome.min.css" rel="stylesheet">
  <link href="../<?=CSS?>main.css" rel="stylesheet">
  <link href="../<?=CSS?>chatbox.css" rel="stylesheet">
  <script src="../<?=JS?>jquery.min.js"></script>
  <script src="../<?=JS?>bootstrap.min.js"></script>
</head>
<body>
  <?Php include(HEADER); ?>
  <div class="row">
    <!-- MESSAGES SPACE-->
    <div class="col-sm-12 col-md-8 chatbox_messages_space"> *
      <form method="POST" action="#" class="">
        <input type="text" name="message" placeholder="Tapez votre message: ">
        <input type="submit" name="envoyer" placeholder="Tapez votre message: ">
      </form>
    </div>
    <!-- END MESSAGES SPACE-->
    <!-- USERS CONNECTED SPACE-->
    <div class="col-md-4 chatbox_connected_users"> *

    </div>
    <!-- END USERS CONNECTED SPACE-->
  </div>
  <script src="../<?=JS?>main.js"></script>
  <?php include(FOOTER); ?>
</body>
</html>
