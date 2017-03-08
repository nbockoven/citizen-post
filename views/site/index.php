<?php

/* @var $this yii\web\View */

$this->title = 'Citizen National News';
?>

<div class="card-columns">

    <? $counter = 0; foreach( $articles as $article ): $counter++; ?>
        <? if( $counter % 4 == 0 ): ?>
            <?= $this->render('templates/listing_ad'); ?>
        <? endif; ?>
        <?= $this->render('templates/listing_article', ['article' => $article]); ?>
    <? endforeach; ?>

</div><!-- .card-columns -->

<a href="javascript:void(0)" class="btn btn-block btn-danger load-more-articles">View More</a>
