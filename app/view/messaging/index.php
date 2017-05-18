<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include(META); ?>
  <link rel="icon" href="<?=FAVICON?>">
  <title>CMS FORUM</title>
  <link href="../<?=CSS?>bootstrap.min.css" rel="stylesheet">
  <link href="../<?=CSS?>font-awesome.min.css" rel="stylesheet">
  <link href="../<?=CSS?>main.css" rel="stylesheet">
  <script src="../<?=JS?>jquery.min.js"></script>
  <script src="../<?=JS?>bootstrap.min.js"></script>
  <link href="../<?=CSS?>messaging.css" rel="stylesheet">
</head>
<body>
  <?Php include(HEADER); ?>
  <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ ?>
    <div id="sendmessage" class="col-sm-12 col-md-12 col-lg-12">
        <!-- MESSAGES SPACE-->
        <div class="col-sm-12 col-lg-8 col-md-8 messaging_messages_space"></div>
        <!-- END MESSAGES SPACE-->
        
        <!-- USERS CONNECTED SPACE-->
            <div class="col-md-4 col-lg-4 messaging_connected_users">
                <p style="font-size: 18px; margin-top: 20px; color: white;">Utilisateurs connect&eacutes</p>
            </div>
        <!-- END USERS CONNECTED SPACE-->
        <div class="row">
            <div class="col-sm-12">
                <div id="horiz-bar"></div>
            </div>
        </div>
        <!-- FORM -->
            <form method="POST" action="#" class="">
                <input type="text" id="type" class="stroke_zone" name="message" maxlenght="160" placeholder="Tapez votre message: ">
                <input type="submit" class="envoyer" name="envoyer" placeholder="Tapez votre message: ">
            </form>
            <br>
        <!-- END FORM -->
    </div>
  <br><br>
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
                method: "POST", 
                data: { action: "get_connected" },
                dataType: "json",
                success: function(data) {
                    var count=0;
                    for (i = 0; i < data.length; i++) {
                        count++;
                        $(".messaging_connected_users").html("<div class=\"profanddate\"><img alt=\""count"\" src=\"" + data[i]["profile_img"] + "\" class=\"profimg\"><p>" + data[i][username] + "</p></div>;
                    }
                }
            });
        }, 1000)

        setInterval(function() {
            $.ajax({
                url: "../../app/model/messaging/index.php",
                method: "POST", 
                data: { action: "get_messages" },
                dataType: "json",
                success: function(data) {
                    var count=0;
                    for (i = 0; i < data.length; i++) {
                        if (data[i]["author_id"] == id) {
                            $(".messaging_messages_space").html("<span class=\"right\"><div class=\"profanddate\"><p>" + data[i][username] + "</p><img alt=\""count"\" src=\"" + data[i]["profile_img"] + "\" class=\"profimg\"><p class=\"date\">" + data[i]["message_date"] + "</p></div><p>" + data[i]["message"] + "<p></p></span><div class=\"clear\"></div>");
                        } else {
                            $(".messaging_messages_space").html("<span class=\"left\"><div class=\"profanddate\"><p>" + data[i][username] + "</p><img alt=\""count"\" src=\"" + data[i]["profile_img"] + "\" class=\"profimg\"><p class=\"date\">" + data[i]["message_date"] + "</p></div><p>" + data[i]["message"] + "<p></p></span><div class=\"clear\"></div>");
                        }
                    }
                }
            });
        }, 1000)
    </script>
    <?php } else{ ?>
        <h1>Pour pouvoir utiliser le service de messagerie instantan&eacutee veuillez vous connecter svp</h1>
        <script>
            $('.login-modal').modal('show'); //The modal for connection appears
        </script>
    <?php } ?>
  <?php include(FOOTER); ?>
</body>
</html>
