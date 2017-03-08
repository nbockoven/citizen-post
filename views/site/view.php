<? $this->title = $article['title'].' | Citizen National News'; ?>

<div class="card card-block">
    <h2 class="mt-0 mb-3"><?= $article['title'];?></h2>

    <img src="images/articles/<?= $article['image']['large']; ?>" alt="Article Image" class="w-100 mb-3" style="min-height:200px">

    <div class="article-body">
        <?= $article['body'];?>
    </div><!-- /.article-body -->

    <div class="card card-inverse card-primary mb-3">
        <div class="card-block align-middle">
            <span class="align-middle"><i class="fa fa-5x fa-facebook"></i> Facebook comments widget here.</span>
        </div><!-- /.card-block -->
    </div><!-- /.card -->

    <h3 class="heading mb-3 py-2">Trending News</h3>

    <div class="card-deck">
        <? foreach( $trending as $trend ): ?>
            <?= $this->render('templates/listing_article', ['article' => $trend, 'cardColor' => 'card-inverse bg-inverse']); ?>
        <? endforeach; ?>
    </div><!-- /.card-deck -->
</div><!-- /.card card-block -->
