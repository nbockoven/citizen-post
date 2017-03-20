<?
    $cardColor = ( isset( $cardColor ) ) ? $cardColor: 'bg-white';
?>

<a href="/<?= $article['canonical']; ?>" class="media mb-4 <?=$cardColor;?>">
    <img src="images/articles/<?= $article['image']['small']; ?>" alt="Article Image" class="d-flex mr-2" width="200">
    <div class="media-body px-4 align-self-center">
        <h5 class="m-0"><?= $article['title']; ?></h5>
    </div><!-- /.media-body -->
</a><!-- /.media -->
