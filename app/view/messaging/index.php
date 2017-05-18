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
  <script src="../<?=JS?>jquery.nicescroll.min.js"></script>
  <script src="../<?=JS?>bootstrap.min.js"></script>
  <link href="../<?=CSS?>messaging.css" rel="stylesheet">
  <script type="text/javascript">
    $(document).ready(function() {
      $("#messagebox").niceScroll({cursorcolor:"#ececec", cursorborder: "2px solid #333", autohidemode: false, cursorwidth: "7px"});
    });
  </script>
</head>
<body>
  <?Php include(HEADER); ?>
  <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ ?>
    <div id="sendmessage" class="col-sm-12 col-md-12 col-lg-12">
        <!-- MESSAGES SPACE-->
        <div id="messagebox" class="col-sm-12 col-lg-8 col-md-8 messaging_messages_space"></div>
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
        <input type="text" id="type" class="stroke_zone" maxlenght="160" placeholder="Tapez votre message: ">
        <button id="envoyer" type="button" name="button">Envoyer</button>
        <br>
    </div>
  <br><br>
  <script src="../<?=JS?>main.js"></script>
  <script>
    //Case where we add a message
    var id = "<?=$_SESSION['id']?>";
    function push_message(){
      $.ajax({
          url: "../../../app/model/messaging/index.php",
          method: "POST",
          data: { action: "push_message", content: $('#type').val(), id:id },
          success: function(){
            $('#type').val("");
          }
      });
      $('.messaging_messages_space').animate({scrollTop:$(".messaging_messages_space").height()}, 'slow');  //scroll to the bottom of the chat
    }
    $('#envoyer').click(function() {
      push_message();
    });
    $('#type').keypress(function (e) {
      if (e.which == 13) {
        push_message();
      }
    });
    var html = $(".messaging_messages_space").html();
    var htmluser = $(".messaging_connected_users").html();
    setInterval(function() {
            $.ajax({
                url: "../../app/model/messaging/index.php",
                method: "POST",
                data: { action: "get_connected" },
                dataType: "json",
                success: function(data) {
                    var count=0;
                    htmluser="";
                    for (i = 0; i < data.length; i++) {
                        count++;
                        htmluser+="<div class=\"profanddate\"><img alt='"+count+"' src='" + data[i]["profile_img"] + "' class=\"profimg\"><p>" + data[i]["username"] + "</p></div>";
                    }
                }
            });
            $.ajax({
                url: "../../app/model/messaging/index.php",
                method: "POST",
                data: { action: "get_messages" },
                dataType: "json",
                success: function(data) {
                    var count=0;
                    html="";
                    for (i = 0; i < data.length; i++) {
                        if (data[i]["author_id"] == id) {
                            html+="<img alt='"+count+"' src='" + data[i]["profile_img"] + "' class=\"profimgr\"><span class=\"right\"><div class=\"profanddate\"><p style='float: right;'>" + data[i]["message_date"] + "<p style='font-weight: bold;'>" + data[i]["username"] + "</p></p></div><p class='messcontent'>" + data[i]["message"] + "<p></p></span><div class=\"clear\"></div>";
                        } else {
                            html+="<img alt='"+count+"' src='" + data[i]["profile_img"] + "' class=\"profimgl\"><span class=\"left\"><div class=\"profanddate\"><p style='float: right;'>" + data[i]["message_date"] + "<p style='font-weight: bold;'>" + data[i]["username"] + "</p></p></div><p class='messcontent'>" + data[i]["message"] + "<p></p></span><div class=\"clear\"></div>";
                        }
                    }
                }
            });
            $(".messaging_connected_users").html(htmluser);
            $(".messaging_messages_space").html(html);

        }, 1000);
        $('.messaging_messages_space').animate({scrollTop:$(".messaging_messages_space").height()}, 'slow');  //scroll to the bottom of the chat
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
