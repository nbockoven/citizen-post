<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="icon" href="favicon.ico" sizes="16x16 32x32">
    <?php $this->head() ?>
</head>
<body class="bg-green-lightest">
  <?php $this->beginBody() ?>

  <div class="container-fluid">
    <?= $this->render('//parts/header.php'); ?>
    <div class="row">
      <div class="col-xl-3 hidden-lg-down">
        <div class="ad-block d-block text-center sticky-top">
          <img src="images/unicorn.jpg" alt="ad space here" class="img-fluid mb-3" style="width:336px;height:280px;">
          <img src="images/unicorn.jpg" alt="ad space here" class="img-fluid mb-3" style="width:336px;height:280px;">
        </div><!-- /.d-block -->
      </div><!-- /.col-lg-2 hidden-md-down -->
      <div class="col-lg-8 col-xl-6">
        <!-- <img src="images/unicorn.poop.jpg" alt="ad space here" class="img-fluid mb-3 d-flex mx-auto" style="width: 970px; height: 90px;"> -->
        <?= $content ?>
      </div><!-- /.col -->
      <div class="col-lg-4 col-xl-3 hidden-md-down">
        <div class="ad-block d-block text-center sticky-top">
          <img src="images/unicorn.jpg" alt="ad space here" class="img-fluid mb-3" style="width:336px;height:280px;">
          <img src="images/unicorn.jpg" alt="ad space here" class="img-fluid mb-3" style="width:336px;height:280px;">
        </div><!-- /.d-block -->
      </div><!-- /.col l4 m3 s2 -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->

  <footer class="text-white bg-inverse small mt-3">
    <div class="container py-6">
      <div class="row">
        <div class="col-lg-6">
          <h5>Citizen National</h5>
          <p class="text-green-dark">
            These articles are in jest; purely for fun and entertainment purposes. Some are based on true events and stories, but altered to tell a more compelling, fictional tale.
          </p>
        </div><!-- .col -->
        <div class="col-6 col-lg-3 text-lg-center">
          <h5>Settings</h5>
          <ul class="list-unstyled">
            <li><a href="#!">Link 1</a></li>
            <li><a href="#!">Link 2</a></li>
            <li><a href="#!">Link 3</a></li>
            <li><a href="#!">Link 4</a></li>
          </ul>
        </div><!-- .col -->
        <div class="col-6 col-lg-3 text-lg-center">
          <h5>Connect</h5>
          <ul class="list-unstyled mb-0">
            <li><a href="#!">Link 1</a></li>
            <li><a href="#!">Link 2</a></li>
            <li><a href="#!">Link 3</a></li>
            <li><a href="#!">Link 4</a></li>
          </ul>
        </div><!-- .col -->
      </div><!-- .row -->
    </div><!-- .container -->
  </footer>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
