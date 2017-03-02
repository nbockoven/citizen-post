<?
    $number = intval( $number % 2 == 0 );

    $subjects = [
        [
            'url'      => '#',
            'name'     => 'trump',
            'headline' => "Trump says, &#8220;There's no time for us&#8221;",
            'blurb'    => "There's no place for us. What is this thing that builds our dreams, yet slips away from us?",
        ],
        [
            'url'      => '#',
            'name'     => 'unicorn',
            'headline' => "&#8220;Who wants to live forever?&#8221;, inquire the Unicorns",
            'blurb'    => "Who wants to live forever? Oh ooo oh &#8212; There's no chance for us",
        ],
    ];
?>

<a class="media" href="<?= $subjects[$number]['url']; ?>">
    <img src="images/<?= $subjects[$number]['name']; ?>.jpg" alt="<?= $subjects[$number]['name']; ?>" class="d-flex mr-3" width="100" height="100">
    <div class="media-body">
        <h4><?= $subjects[$number]['headline']; ?></h4>
        <p class="mb-0"><?= $subjects[$number]['blurb']; ?></p>
    </div><!-- /.media-body -->
</a><!-- /.media -->
