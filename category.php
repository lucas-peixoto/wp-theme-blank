<?php get_header(); ?>

	<div class="post-content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="post">
				<h2>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="Link para <?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<small><?php the_date(); ?> ás <?php the_time(); ?> por <?php the_author_posts_link(); ?></small>
			</div>
		<?php endwhile; else : ?>
			<p>Nenhum resultado encontrado</p>
		<?php endif; ?>
		<?php wp_pagination(); ?>
	</div>

<?php get_footer(); ?>
