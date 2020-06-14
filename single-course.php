<?php acf_form_head(); ?>

<?php
/**
 * The template for displaying all single posts
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-course-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<h1><?php the_title();?></h1>
				<!--DATE REPEATER-->	
					<?php if( have_rows('dates') ): ?>
						<div class="date-holder holder">
							<h2>Course Dates</h2>
							<div class="row date-row">								
								<div class="col-md-3">
									<h3>Registration Start Date</h3>
								</div>
								<div class="col-md-3">
									<h3>Registration End Date</h3>
								</div>
								<div class="col-md-3">
									<h3>Course Start Date</h3>
								</div>
								<div class="col-md-3">
									<h3>Course End Date</h3>
								</div>
							</div>
		
							<?php while( have_rows('dates') ): the_row(); 
								// vars
								$reg_start = get_sub_field('registration_start_date');
								$reg_end = get_sub_field('registration_end_date');
								$course_start = get_sub_field('course_start_date');
								$course_end = get_sub_field('course_end_date');

								?>
								<div class="row single-date">								
									<div class="col-md-3">
										<?php if( $reg_start ): ?>
											<?php echo $reg_start; ?>
										<?php endif; ?>
									</div>
									<div class="col-md-3">
										<?php if( $reg_end ): ?>
											<?php echo $reg_end; ?>
										<?php endif; ?>
									</div>
									<div class="col-md-3">
										<?php if( $course_start ): ?>
											<?php echo $course_start; ?>
										<?php endif; ?>
									</div>
									<div class="col-md-3">
										<?php if( $course_end ): ?>
											<?php echo $course_end; ?>
										<?php endif; ?>
									</div>
								</div>
										

							<?php endwhile; ?>
						</div>
						<?php endif; ?>
				<!--END DATE REPEATER-->
				<!--SHORT DESCRIPTION-->
				<div class="short-holder holder">	
                    <?php 
						$short_course_description = get_field('short_course_description');
						echo '<h2>Short Course Description</h2><div class="short-description">' . $short_course_description . '</div>';
					;?>
				</div>
				<!--END SHORT DESCRIPTION-->
				<!--LONG DESCRIPTION-->
				<div class="long-holder holder">
					<?php 
						$long_course_description = get_field('long_course_description');
						echo '<h2>Long Course Description</h2><div class="long-description">' . $long_course_description . '</div>';
					;?>
				</div>
				<!--END LONG DESCRIPTION-->
			<?php if (current_user_can( 'edit_post', $post->ID )) :?>
				<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#editCourse" aria-expanded="false" aria-controls="collapseExample">
			    	Edit/Update Your Course
			  	</button>
			  	<div class="collapse" id="editCourse">
		            <?php             
		            $post_id = get_the_ID();
		            acf_form(array(
				        'post_id'       => $post_id,
				        'post_title'    => false,
				        'post_content'  => false,
				        'submit_value'  => __('Update Course Information'),
				        'updated_message' => __("Course successfully updated", 'acf'),
				        'html_updated_message'  => '<div id="message" class="updated"><p>%s</p></div>',
				    )); ?>
				</div>
			<?php endif; ?>
       <?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer();
