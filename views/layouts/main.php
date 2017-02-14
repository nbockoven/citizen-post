<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use macgyer\yii2materializecss\widgets\Nav;
use macgyer\yii2materializecss\widgets\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="blue-grey darken-1">
  <?php $this->beginBody() ?>

  <nav class="mb-1">
    <div class="nav-wrapper white">
      <a href="/" class="brand-logo center blue-grey-text text-darken-2">Citizen Post</a>
    </div>
  </nav>

  <div class="row mb-0">
    <div class="col s12">
      <div class="card-panel grey accent-1">
        <img src="images/ad-space.jpg" alt="ad space here">
      </div><!-- /.card-panel grey accent-1 -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <div class="row">
    <div class="col l8">
      <?= $content ?>
    </div><!-- /.col l8 m9 s10 -->
    <div class="col l4 hide-on-med-and-down">
      <div class="card-panel grey accent-1 center-align">
        <img src="images/ad-space.jpg" alt="ad space here" class="responsive-img" style="width:300px;height:250px;">
      </div><!-- /.card-panel grey accent-1 -->

      <div class="card-panel grey accent-1 center-align">
        <img src="images/ad-space.jpg" alt="ad space here" class="responsive-img" style="width:300px;height:250px;">
      </div><!-- /.card-panel grey accent-1 -->
    </div><!-- /.col l4 m3 s2 -->
  </div><!-- /.row -->


  <footer class="page-footer grey darken-3">
    <div class="container">
      <div class="row mb-0">
        <div class="col l6 s12">
          <h5 class="white-text">Citizen Post</h5>
          <p class="grey-text text-lighten-4">
            These articles are in jest; purely for fun and entertainment purposes. There isn't much truth to them. Some are based on true events and stories, but altered to tell a more compelling tale.
          </p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div><!-- .row -->
    </div>
  </footer>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
