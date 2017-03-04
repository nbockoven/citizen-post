<h2 class="mt-0 mb-3"><?= $article['title'];?></h2>

<img src="images/articles/<?= $article['image']['large']; ?>" alt="Article Image" class="w-100 mb-3 img-thumbnail">

<div class="article-body">
    <?= $article['body'];?>
</div><!-- /.article-body -->

<h3 class="heading py-2">Trending News</h3>

<div class="card-deck">
    <? foreach( $trending as $trend ): ?>
        <?= $this->render('templates/listing_article', ['article' => $trend]); ?>
    <? endforeach; ?>
</div><!-- /.card-deck -->
