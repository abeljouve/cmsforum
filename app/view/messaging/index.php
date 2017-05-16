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
        <form id="sendmessage" method="POST" action="#" class="">
          <input type="text" class="stroke_zone" name="message" maxlenght="160" placeholder="Tapez votre message: ">
          <input type="submit" class="envoyer" name="envoyer" placeholder="Tapez votre message: ">
        </form>
      </div>
    </div>
    <!-- END MESSAGES SPACE-->
    <!-- USERS CONNECTED SPACE-->
    <div class="col-md-4 messaging_connected_users">
      <p style="font-size: 18px; margin-top: 20px; color: #333333;">Utilisateurs connect&eacutes</p>
    </div>
    <!-- END USERS CONNECTED SPACE-->
    </div>
  </div>
  <script src="../<?=JS?>main.js"></script>
  <script>
    //Case where we add a message
    $('form#envoiemessage').submit(function(event) {
        $.ajax({
            url: "../../../app/model/messaging/index.php",
            method: "POST",
            data: { action: "push_message", content: $('form#sendmessage').value }
        });
    });


setInterval(function() {
        $.ajax({
            url: "../../app/model/messaging/index.php",
            method: "POST", // au lieu de get sinon ne rentre pas dans le switch de index.php
            data: { action: "get_messages" },
            dataType: "json",
            success: function(data) {
                for (i = 0; i < length(data); i++) {
                    var id = "<?=$_SESSION['id']?>";
                    if (data[i]["author_id"] == id) {
                        $(".messaging_messages_space").html("<span class=\"right\">" + data[i][message] + "</span><div class=\"clear\"></div>");
                    } else {
                        $(".messaging_messages_space").html("<span class=\"left\">" + data[i][message] + "</span><div class=\"clear\"></div>");
                    }
                }
            }
        });
    }, 1000)
</script>
  <?php include(FOOTER); ?>
</body>
</html>
