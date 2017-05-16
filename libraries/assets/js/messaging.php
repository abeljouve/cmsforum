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
            url: "../../../app/model/messaging/index.php",
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