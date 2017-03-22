<?
    $bgColor = ( isset( $bgColor ) ) ? $bgColor: 'bg-tan';
?>

<a href="/<?=$article['canonical'];?>" class="row p-4 <?=$bgColor;?>">
    <div class="col-12">
        <img src="images/articles/<?= $article['image']['small']; ?>" alt="Article Image" class="img-fluid mb-2">
    </div><!-- /.col-12 -->
    <div class="col-12">
        <?= $article['title']; ?>
    </div><!-- /.col-12 -->
</a><!-- /.row -->
