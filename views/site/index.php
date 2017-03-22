<?php

/* @var $this yii\web\View */

$this->title   = 'Citizen National News';
$countArticles = count( $articles );
?>

<? if( $countArticles ): ?>

  <div class="row bg-white">
    <div class="hidden-xs-down col-sm-4 col-md-3 col-lg-2 listing sticky-top bg-tan">
      <? $counter = 0; foreach( $articles as $article ): $counter++; ?>
        <?= $this->render('templates/listing_article_media', ['article' => $article, 'bgColor' => ( $counter > 1 ) ? '' : 'bg-white' ]); ?>
      <? endforeach; ?>
    </div><!-- /.col-3 -->
    <div class="col">
      <?= $this->render('view', ['article' => $articles[0]]); ?>
    </div><!-- /.col -->
  </div><!-- /.row -->

<? else: ?>

  There are no articles found.

<? endif; ?>
