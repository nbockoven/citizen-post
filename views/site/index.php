<?php

/* @var $this yii\web\View */

$this->title = 'Citizen Post News';
?>

<? for( $i = 1; $i <= 10; $i++ ): ?>
    <? if( $i > 1 ) echo '<hr>'; ?>
    <?= $this->render('templates/result', ['number' => $i]) ?>
<? endfor; ?>
