<?php
/**
 * Single post lesson partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
	
			<?php //understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content row">

		<?php the_content(); ?>
		<div class="sols col-md-6">
			<h2>SOLs</h2>
			<?php the_field('sols');?>
		</div>
		<div class="eng-focus col-md-6">
			<h2>Engineering Focus</h2>
			<?php the_field('engineering_focus');?>
		</div>
		<div class="material col-md-6">
			<h2>Material</h2>
			<?php the_field('material');?>
		</div>
		<div class="time col-md-6">
			<h2>Time</h2>
			<?php the_field('time_needed');?>
		</div>
		<div class="description col-md-6">
			<h2>Description</h2>
			<?php the_field('description');?>
		</div>
		<div class="alts col-md-6">
			<h2>Alternatives or Extensions</h2>
			<?php the_field('alternatives');?>
		</div>
		<div class="reflection col-md-6">
			<h2>Reflection Suggestions</h2>
			<?php the_field('reflection');?>
		</div>
		<div class="google-folder col-md-12">
			<h2>Resources</h2>
			<?php 
			if(get_field('google_folder_link')){
				$url = get_field('google_folder_link');
				$google_id = explode("/",$url)[5];
				echo '<iframe src="https://drive.google.com/embeddedfolderview?id='.$google_id.'#list" width="100%" height="300" frameborder="0"></iframe>';
			}
			?>						
		</div>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
