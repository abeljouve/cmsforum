<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include(META); ?>
  <link rel="icon" href="<?=FAVICON?>">
  <title>CMS FORUM</title>
  <link href="<?=CSS?>bootstrap.min.css" rel="stylesheet">
  <link href="<?=CSS?>font-awesome.min.css" rel="stylesheet">
  <link href="<?=CSS?>main.css" rel="stylesheet">
  <script src="<?=JS?>jquery.min.js"></script>
  <script src="<?=JS?>bootstrap.min.js"></script>
</head>
<body>
  <?Php include(HEADER); ?>
  <div class="row">
    <div class="latest-news">
      <?php
      if ($stmt->execute()) { ?>
        <article class="full-width">
          <a href="#">
            <header>
              <span class="article-id">#00001</span>
              <h3>Titre article</h3>
              <span class="article-author">pseudo auteur</span>
              <span class="article-author">03/04/2017 09:49</span>
            </header>
            <picture>
              <!--[if IE 9]><video style="display: none;"><![endif]-->
              <source srcset="<?=IMG?>test1.jpg" media="(min-width: 1169px)">
              <source srcset="<?=IMG?>test1.jpg" media="(min-width: 735px)">
              <source srcset="<?=IMG?>test1.jpg" media="(min-width: 360px)">
              <!--[if IE 9]></video><![endif]-->
              <!--[if lt IE 9]>
              <img src="<?=IMG?>test1.jpg" alt="" />
              <![endif]-->
              <!--[if !lt IE 9]> -->
              <img srcset="<?=IMG?>test1.jpg" alt="" class="js-object-fit-img">
              <!-- <![endif]-->
            </picture>
          </a>
        </article>
      <?php }else {
        //Erreur lors de la requette SQL
      }
       ?>
      <article class="tier-width">

      </article>
    </div>
  </div>
  <?php include(FOOTER); ?>
</body>
</html>
