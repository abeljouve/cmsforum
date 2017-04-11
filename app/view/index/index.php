<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include(META); ?>
  <link rel="icon" href="<?=FAVICON?>">
  <title>CMS FORUM</title>
  <link href="<?=CSS?>bootstrap.min.css" rel="stylesheet">
  <link href="<?=CSS?>font-awesome.min.css" rel="stylesheet">
  <link href="<?=CSS?>main.css" rel="stylesheet">
  <link href="<?=CSS?>index.css" rel="stylesheet">
  <script src="<?=JS?>jquery.min.js"></script>
  <script src="<?=JS?>bootstrap.min.js"></script>
</head>
<body>
  <?Php include(HEADER); ?>
  <div class="row">
    <div class="latest-news col-lg-12">
      <?php
      if ($stmt->rowCount()>0) {
        $res = $stmt->fetchAll();
        ?>
        <article class="full-width">
          <a href="#">
            <header>
              <span class="article-id"><?=$res[0]["id"]?></span>
              <h3><?=$res[0]["title"]?></h3>
              <span class="article-author"><?=$res[0]["username"]?></span>
              <span class="article-date"><?=$res[0]["date"]?></span>
            </header>
            <img srcset="<?=$res[0]['picture']?>" alt="" class="js-object-fit-img">
          </a>
        </article>
        <article class="tier-width">
          <a href="#">
            <header>
              <span class="article-id"><?=$res[1]["id"]?></span>
              <h3><?=$res[1]["title"]?></h3>
              <span class="article-author"><?=$res[1]["username"]?></span>
              <span class="article-date"><?=$res[1]["date"]?></span>
            </header>
            <img srcset="<?=$res[1]['picture']?>" alt="" class="js-object-fit-img">
          </a>
        </article>
        <article class="tier-width">
          <a href="#">
            <header>
              <span class="article-id"><?=$res[2]["id"]?></span>
              <h3><?=$res[2]["title"]?></h3>
              <span class="article-author"><?=$res[2]["username"]?></span>
              <span class="article-date"><?=$res[2]["date"]?></span>
            </header>
            <img srcset="<?=$res[2]['picture']?>" alt="" class="js-object-fit-img">
          </a>
        </article>
        <article class="tier-width">
          <a href="#">
            <header>
              <span class="article-id"><?=$res[3]["id"]?></span>
              <h3><?=$res[3]["title"]?></h3>
              <span class="article-author"><?=$res[3]["username"]?></span>
              <span class="article-date"><?=$res[3]["date"]?></span>
            </header>
            <img srcset="<?=$res[3]['picture']?>" alt="" class="js-object-fit-img">
          </a>
        </article>
      <?php }else {
        //Erreur lors de la requette SQL
      }
       ?>
    </div>
  </div>
  <?php include(FOOTER); ?>
</body>
</html>
