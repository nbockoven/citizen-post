<?
    $cardColor = ( isset( $cardColor ) ) ? $cardColor: '';
?>

<a href="/<?= $article['canonical']; ?>" class="card mb-4 <?=$cardColor;?>">
    <img src="images/articles/<?= $article['image']['small']; ?>" alt="Article Image" class="card-img-top w-100">
    <div class="card-block">
        <h5 class="card-title m-0"><?= $article['title']; ?></h5>
    </div><!-- /.card-block -->
</a><!-- /.card -->
