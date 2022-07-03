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
					<?php 
					if(get_field('featured_image')){
						$img = get_field('featured_image');
						$title = get_the_title();
						echo "<img src='{$img['sizes']['course-image']}' class='img-fluid course-image' alt='{$title} representative image.'>";
						}					
					?>
					<h1><?php the_title();?></h1>
					<div class="uni"><?php echo aln_university();?></div>
				
				<div class="row">
					<div class="col-md-6">
						<h2>Registration Fee</h2>
						<div class="fee"><?php echo aln_registration_fee();?></div>
					</div>
					<div class="col-md-6">
						<h2>Learner Engagement</h2>
						<div class="hours"><?php echo aln_engagement_hours();?></div>
					</div>
					<div class="col-md-12 link-row">
						<?php if (aln_registration_link() != FALSE) : ?>
						<h2>PSI Registration Page</h2>
						<div class="registration-link"><?php echo aln_registration_link();?></div>
						<?php else : ?>
						<h2>PSI Registration Contact</h2>
						<?php echo aln_registration_contact();?>
					<?php endif;?>
					</div>					
				</div>

				<!--DATE REPEATER-->
				<div class="date-holder holder table-responsive" id="dates">
							<h2>Course Dates</h2>
							<table class="table">
									  <thead>
									    <tr>
									      <th scope="col">Course Start Date</th>
									      <th scope="col">Course End Date</th>
									    </tr>
									  </thead>
									  <tbody>
			
					<?php if( have_rows('dates') ): ?>
						
							<?php while( have_rows('dates') ): the_row(); 
								
								if(get_sub_field('course_start_date')){
									$course_start = get_sub_field('course_start_date');									
								} else {
									$course_start = 'Not Entered';
								}
								if(get_sub_field('course_end_date')){
									$course_end = get_sub_field('course_end_date');
								} else {
									$course_end = 'Not entered';
								}
								
								?>
								
									    <tr>									  
									    
										<?php if( $course_start ): ?>
											<?php echo '<td>' . $course_start . '</td>' ; ?>
										<?php endif; ?>
									    <?php if( $course_end ): ?>
											<?php echo '<td>' . $course_end . '</td>' ; ?>
										<?php endif; ?>
										
									    </tr>									 
										

							<?php endwhile; ?>
							<?php else: ?>
							<p>You have not indicated any dates. Dates are key to marketing your course.</p>
							
						<?php endif; ?>
						 		</tbody>
							</table>
						</div>
				<!--END DATE REPEATER-->
				<!--SHORT DESCRIPTION-->
				<div class="short-holder holder" id="short-desc">	
                  <h2>Short Course Description</h2>
                  <div class="short-description">
                  	<?php echo aln_short_course_description();?>
                  </div>
				</div>
				<!--END SHORT DESCRIPTION-->
							
				<!--COURSE INSTRUCTOR-->
				<div class="instructor holder" id="instructor">					
					<h2>Instructor</h2>
					<div class="row">					
						<div class="col-md-12">
						<h3><?php echo aln_instructor_name();?></h3>
						<p><?php echo aln_instructor_bio();?></p>
						</div>
					</div>
				</div>
				<!--END INSTRUCTOR-->
			
				
			<?php 
				if(get_field('allowed_editors')){
					$allowed_editors = get_field('allowed_editors');				

				} else {
					$allowed_editors = [];
				}
				if (current_user_can( 'edit_post', $post->ID ) || in_array(get_current_user_id(), $allowed_editors)) 
					:?>
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
