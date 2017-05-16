<?php 
    include 'message.php';
    include 'GestMessage.php';

    //JQuery retourne un tableau associatif POST en php on fait donc un switch qui selon la donnée transmise chope la bonne fonction avec la donnée si nécessaire en paramètre

    if(isset($_POST['action']) && !empty($_POST['action'])){
        switch($_POST['action']){
            case "push_message":
                $MessAdded = new $Message($_SESSION['id'],$_POST['content']); //We create the message
                $GestMessage::addMessage($MessAdded);   //We send it
                break;
            
            case "get_messages":
                echo $GestMessage::getMessages();
                break;
        }
    }

?>
