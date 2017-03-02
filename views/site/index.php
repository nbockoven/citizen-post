<?php

/* @var $this yii\web\View */

$this->title = 'Citizen National News';
?>

<div class="card-columns">

    <? $counter = 0; foreach( $articles as $article ): $counter++; ?>

        <? if( $counter % 4 == 0 ): ?>
            <div class="card">
                <img src="#" alt="Ad space here" class="card-img w-100">
            </div><!-- /.card -->
        <? endif; ?>

        <div class="card card-inverse">
            <img src="<?= $article['image']; ?>" alt="Article Image" class="card-img w-100">
            <div class="card-img-overlay d-flex align-content-end">
                <h4 class="card-title text-white mt-auto mb-0 p-1 bg-transparentish"><?= $article['title']; ?></h4>
            </div><!-- /.card-img-overlay -->
        </div><!-- /.card card-inverse -->
    <? endforeach; ?>

</div><!-- .card-columns -->
