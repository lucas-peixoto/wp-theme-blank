<?php
$cat = 'Category Name';
$ppp = 3;
$catID = (int) get_cat_ID($cat);
$loop = new WP_Query( array( 'cat' => $catID, 'posts_per_page' => $ppp ) );
$posts = [];

if( $loop->have_posts() ){
    while( $loop->have_posts() ) {
        $loop->the_post();
        $p = [];

        $p['thumbnail'] = get_the_post_thumbnail_url(null, 'medium', '');
        $p['title']     = get_the_title();
        $p['permalink'] = get_the_permalink();
        $p['date']      = get_the_date('d-m-Y');

        array_push($posts, $p);
    } ?>

    <div class="row">
    <?php foreach ($posts as $p) { ?>
    <?php var_dump($p) ?>
        <div class="col-12 col-sm-6 col-md-6">
            <a href="<?= $p['permalink'] ?>"></a>
        </div>
    <?php } ?>
    </div>
</div>

<?php } ?>
