<?php
$stmt = $PDOStatement->prepare("SELECT * FROM article INNER JOIN user ON article.id_author=user.id ORDER BY date DESC LIMIT 4");
$stmt->execute();

 ?>
