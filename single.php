<?php get_header(); ?>

        <div class="post-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="post">
  		    		<small><?php the_date(); ?> ás <?php the_time(); ?> por <?php the_author_posts_link(); ?></small>
                    <h2 class="the_title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="Link para <?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <!-- <img class="post-thumbnail img-responsive" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"> -->
                    <div class="the_content">
                        <?php the_content(); ?>
                    </div>
            	</div>
            <?php endwhile; else : ?>
                <p>Nenhum resultado encontrado</p>
            <?php endif; ?>
        </div>

<?php get_footer(); ?>
