<?php
$cat = 'Category Name';
$ppp = 3;
$catID = (int) get_cat_ID($cat);
$loop = new WP_Query( array( 'cat' => $catID, 'posts_per_page' => $ppp ) );
$posts = [];

if( $loop->have_posts() ){
    while( $loop->have_posts() ) {
        $loop->the_post();
        $post = [];

        $post['thumbnail'] = get_the_post_thumbnail_url(null, 'medium', '');
        $post['title']     = get_the_title();
        $post['permalink'] = get_the_permalink();
        $post['date']      = get_the_date('d-m-Y');

        array_push($posts, $post);
    } ?>

    <div class="row">
    <?php foreach ($posts as $post) { ?>
    <?php var_dump($post) ?>
        <div class="col-12 col-sm-6 col-md-6">
            <a href="<?= $post['permalink'] ?>"></a>
        </div>
    <?php } ?>
    </div>
</div>

<?php } ?>
