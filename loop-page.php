<?php
/**
 * The loop that displays a page with sidebar.
 *
 * The loop displays the page and the page content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage distinctionpp
 * @since distinctionpp 1.0
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="post-inner"><article>
                        <?php if ( is_front_page() ) { ?>
						<h2 class="title"><?php the_title(); ?></h2>
						<?php } else { ?>
                        <h1 class="title"><?php the_title(); ?></h1>
                        <?php } ?>
                        <div class="entry">
                            <?php the_content(); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wp_distinctionpp' ), 'after' => '</div>' ) ); ?>
                            <?php edit_post_link( __( 'Edit', 'wp_distinctionpp' ), '<span class="edit-link">', '</span>' ); ?>
    
                        </div><!-- .entry -->
                    </article></div>
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>
                
<?php endwhile; // end of the loop. ?>