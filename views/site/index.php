<?php

/* @var $this yii\web\View */

$this->title   = 'Citizen National News';
?>

<div class="row bg-white">
  <div class="hidden-xs-down col-sm-4 col-lg-3 col-xl-2 bg-tan" id="article-listing"></div><!-- /.col-3 -->
  <div class="col offset-sm-4 offset-lg-3 offset-xl-2" id="article-detail"></div><!-- /.col -->
</div><!-- /.row -->

<? // templates ?>
<?= $this->render('templates/listing'); ?>
<?= $this->render('templates/detail'); ?>
