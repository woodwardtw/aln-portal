<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">
			<?php if ( is_active_sidebar( 'footerleft' ) ) : ?>
				<?php dynamic_sidebar( 'footerleft' ); ?>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footermid' ) ) : ?>
				<?php dynamic_sidebar( 'footermid' ); ?>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footerright' ) ) : ?>
				<?php dynamic_sidebar( 'footerright' ); ?>
			<?php endif; ?>

		
			<div class="col-md-12">
			<?php if ( is_active_sidebar( 'footerleft' ) ) : ?>
				<?php dynamic_sidebar( 'footerfull' ); ?>
			<?php endif; ?>
			</div><!--col end -->
			

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

