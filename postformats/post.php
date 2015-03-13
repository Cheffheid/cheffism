<article id="post-<?php the_ID(); ?>" <?php post_class(get_post_meta(get_the_ID(), 'article_class', true)); ?> role="article">
	<header class="entry-header">
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" 
	title="<?php printf( esc_attr__( 'Permalink to %s', 'cheffism' ), the_title_attribute( 'echo=0' ) ); ?>" 
	rel="bookmark"><?php the_title(); ?></a>
		</h2>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_content(); ?>
	</div><!-- .entry-summary -->
	<footer class="entry-meta">

		<div class="entry-meta">
			<?php 
				_e('Posted on', 'cheffism' );
				printf( ' <a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" itemprop="datePublished">%3$s</time></a> ',
					get_permalink(),
					get_the_date( 'c' ),
					get_the_date()
				);
				_e('by', 'cheffism');
			?>
			<time class="updated hidden"
				datetime="<?php the_modified_date( 'Y-m-d' ); ?>">
					<?php the_modified_date(); ?>
			</time>
			<span class="author post-author vcard">
				<span class="fn">
					<?php the_author_link(); ?>
				</span>
				<link rel="author" href="https://plus.google.com/u/0/+JeffreydeWitCheff"/>
			</span>
		</div><!-- .entry-meta -->

		<?php
			$tag_list = get_the_tag_list( '', ', ' );
			$category = get_the_category();
			
			if ( $category[0]->name == 'Uncategorized' ) {
				$utility_text = __( 'This post is', 'cheffism' );
				$utility_text .= ' <span>%1$s</span> ';
			} else {
				$utility_text = __( 'It\'s probably about', 'cheffism' );
				$utility_text .= ' <span>%1$s</span> ';
			}

			
			if ( '' != $tag_list ) {
				$utility_text .= __('and also', 'cheffism');
				$utility_text .= ' <span>%2$s</span>. ';
			}

			printf(
				$utility_text,
				get_the_category_list( ', ' ),
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>
		<?php if (comments_open()) { ?>
			<p> <a href="<?php the_permalink();?>#comments"><?php _e('Leave a comment!', 'cheffism'); ?></a> </p>
		<?php } ?>	
		<?php edit_post_link( __( 'Edit', 'cheffism' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->