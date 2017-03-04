<?php

/* @var $this yii\web\View */

$this->title = 'Citizen National News';

$bgColors = [
    'bg-success',
    'bg-danger',
    'bg-warning',
];
$primaryBgColor = 'card-inverse bg-inverse';
?>

<div class="card-columns">

    <? $bgIndex = 0; $counter = 0; foreach( $articles as $article ): $counter++; ?>
        <? if( $counter % 3 == 0 ): ?>
            <?
                $bgColor = $bgColors[ $bgIndex ];
                $bgIndex = ( $bgIndex >= 2 ) ? 0 : $bgIndex + 1;
            ?>
        <? elseif( $counter % 4 == 0 ): ?>
            <?= $this->render('templates/listing_ad'); ?>
        <? else: ?>
            <? $bgColor = $primaryBgColor; ?>
        <? endif; ?>

        <?= $this->render('templates/listing_article', ['article' => $article, 'bgColor' => $bgColor]); ?>

    <? endforeach; ?>

</div><!-- .card-columns -->

<a href="javascript:void(0)" class="btn btn-block btn-danger load-more-articles">View More</a>
