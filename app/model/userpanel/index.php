<?php
$stmt1 = $PDOStatement->prepare("SELECT * FROM user WHERE id = :id");
$stmt1->bindParam(":id", $_SESSION["id"], PDO::PARAM_STR);
$stmt1->execute();
$res = $stmt1->fetchAll()[0];
 ?>
