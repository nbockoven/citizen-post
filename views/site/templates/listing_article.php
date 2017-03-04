<?
/*
<a href="#" class="card card-block card-inverse" style="background-image: url(<?=$article['image'];?>);background-size: cover; background-position: center;">
    <h4 class="card-title text-white mt-9 mb-0"><?= $article['title']; ?></h4>
</a><!-- /.card card-inverse -->
*/
$bgColor = ( isset($bgColor) ) ? $bgColor : 'card-inverse bg-inverse';
?>

<a href="/<?= $article['canonical']; ?>" class="card <?= $bgColor; ?> mb-3">
    <img src="images/articles/<?= $article['image']['small']; ?>" alt="Article Image" class="card-img-top w-100">
    <div class="card-block">
        <h5 class="card-title m-0"><?= $article['title']; ?></h5>
    </div><!-- /.card-block -->
</a><!-- /.card card-inverse -->
