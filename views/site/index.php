<?php

/* @var $this yii\web\View */

$this->title   = 'Citizen National News';
$countArticles = count( $articles );
?>

<? if( $countArticles <= 3 ): ?>
  <? foreach( $articles as $article ): ?>
    <?= $this->render('templates/listing_article_media', ['article' => $article]); ?>
  <? endforeach; ?>
<? elseif( $countArticles ): ?>
  <div class="card-columns">
    <? $counter = 0; foreach( $articles as $article ): $counter++; ?>
      <? if( $counter % 4 == 0 ): ?>
        <?= $this->render('templates/listing_ad'); ?>
      <? endif; ?>
      <?= $this->render('templates/listing_article_card', ['article' => $article]); ?>
    <? endforeach; ?>
  </div><!-- /.card-columns -->
<? else: ?>
  There are no articles found.
<? endif; ?>

<? if( $pagination['show'] ): ?>

  <div class="d-flex justify-content-start">
    <a href="?page=<?=$pagination['prev'];?>" class="btn btn-danger <?if( !$pagination['prev'] ):?>disabled<?endif;?>">
      <i class="fa fa-angle-double-left"></i> Prev
    </a>
    <a href="?page=<?=$pagination['next'];?>" class="btn btn-danger ml-auto <?if( $pagination['current'] >= $pagination['total'] ):?>disabled<?endif;?>">
      Next <i class="fa fa-angle-double-right"></i>
    </a>
  </div><!-- /.d-flex justify-content-start -->

<? endif; ?>
