<?php

/* @var $this yii\web\View */

$this->title = 'Citizen National News';
?>

<div class="card-columns" id="article-listing">

  <? $counter = 0; foreach( $articles as $article ): $counter++; ?>
    <? if( $counter % 4 == 0 ): ?>
      <?= $this->render('templates/listing_ad'); ?>
    <? endif; ?>
    <?= $this->render('templates/listing_article', ['article' => $article]); ?>
  <? endforeach; ?>

</div><!-- .card-columns -->

<div class="d-flex justify-content-start">
  <a href="?page=<?=$pagination['prev'];?>" class="btn btn-danger <?if( !$pagination['prev'] ):?>disabled<?endif;?>"><i class="fa fa-angle-double-left"></i> Prev</a>
  <a href="?page=<?=$pagination['next'];?>" class="btn btn-danger ml-auto">Next <i class="fa fa-angle-double-right"></i></a>
</div><!-- /.d-flex justify-content-start -->
