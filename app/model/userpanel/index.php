<?php
$stmt = $PDOStatement->prepare("SELECT * FROM user WHERE id = :id");
$stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_STR);
$stmt->execute();
$res = $stmt->fetchAll()[0];
 ?>
