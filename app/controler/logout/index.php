<?php
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
session_destroy();
header('Location: ../');
 ?>
