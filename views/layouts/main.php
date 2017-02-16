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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="icon" href="favicon.ico" sizes="16x16 32x32">
    <?php $this->head() ?>
</head>
<body class="pt-9">
  <?php $this->beginBody() ?>

  <nav class="navbar navbar-toggleable-md navbar-light bg-info fixed-top">
    <?
      /*
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      */
    ?>

    <a class="navbar-brand font-academic" href="#">C<small>itizen</small> P<small>ost</small></a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?
        /*
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        */
      ?>
      <form class="ml-auto">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-success my-2 my-sm-0" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div><!-- /.input-group -->
      </form>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col text-center">
        <img src="images/ad-space.jpg" alt="ad space here" class="img-fluid mb-3" style="width: 970px; height: 90px;">
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <?= $content ?>
      </div><!-- /.col -->
      <div class="col-lg-4 hidden-md-down">
        <div class="d-block text-center sticky-top">
          <img src="images/ad-space.jpg" alt="ad space here" class="img-fluid mb-3" style="width:336px;height:280px;">
          <img src="images/ad-space.jpg" alt="ad space here" class="img-fluid mb-3" style="width:336px;height:280px;">
        </div><!-- /.d-block -->
      </div><!-- /.col l4 m3 s2 -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->

  <footer class="text-white bg-brown small">
    <div class="container py-6">
      <div class="row">
        <div class="col-lg-6">
          <h5>Citizen Post</h5>
          <p class="text-primary">
            These articles are in jest; purely for fun and entertainment purposes. Some are based on true events and stories, but altered to tell a more compelling, fictional tale.
          </p>
        </div>
        <div class="col-6 col-lg-3 text-lg-center">
          <h5>Settings</h5>
          <ul class="list-unstyled">
            <li><a href="#!">Link 1</a></li>
            <li><a href="#!">Link 2</a></li>
            <li><a href="#!">Link 3</a></li>
            <li><a href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col-6 col-lg-3 text-lg-center">
          <h5>Connect</h5>
          <ul class="list-unstyled mb-0">
            <li><a href="#!">Link 1</a></li>
            <li><a href="#!">Link 2</a></li>
            <li><a href="#!">Link 3</a></li>
            <li><a href="#!">Link 4</a></li>
          </ul>
        </div>
      </div><!-- .row -->
    </div>
  </footer>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
