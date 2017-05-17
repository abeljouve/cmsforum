<?php
if (isset($_SESSION["id"])) {
  include(APP.'model/'.$page.'/index.php');
  include(APP.'view/'.$page.'/index.php');
}else {
  header("Location: .");
}
?>
