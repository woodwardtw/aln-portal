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
						<h2>PSI Registration Page</h2>
						<div class="registration-link"><?php echo aln_registration_link();?></div>
					</div>
				</div>

				<!--DATE REPEATER-->
				<div class="date-holder holder table-responsive" id="dates">
							<h2>Course Dates</h2>
							<table class="table">
									  <thead>
									    <tr>
									      <th scope="col">Offering Number</th>
									      <th scope="col">Registration Start Date</th>
									      <th scope="col">Registration End Date</th>
									      <th scope="col">Course Start Date</th>
									      <th scope="col">Course End Date</th>
									    </tr>
									  </thead>
									  <tbody>
			
					<?php if( have_rows('dates') ): ?>
						
							<?php while( have_rows('dates') ): the_row(); 
								// vars
								if(get_sub_field('registration_start_date')){
									$reg_start = get_sub_field('registration_start_date');
								} else {
									$reg_start = 'Not entered';
								}
								if (get_sub_field('registration_end_date')){
									$reg_end = get_sub_field('registration_end_date');
								} else {
									$reg_end = 'Not entered';
								}
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
								
								$offering_number = get_sub_field('offering_number');
								?>
								
									    <tr>
									    <?php if( $course_end ): ?>
											<?php echo '<td>' . $offering_number . '</td>' ; ?>
										<?php endif; ?>
									    <?php if( $reg_start ): ?>
											<?php echo '<td>' . $reg_start . '</td>' ; ?>
										<?php endif; ?>
									     <?php if( $reg_end ): ?>
											<?php echo '<td>' . $reg_end . '</td>' ; ?>
										<?php endif; ?>
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
				<!--LONG DESCRIPTION-->
				<div class="long-holder holder" id="full-desc">
					<h2>Course Modules</h2>
					<?php if( have_rows('long_course_description') ): ?>
						<?php while( have_rows('long_course_description') ): the_row();
							$module_name = get_sub_field('module_name');
							$module_description = get_sub_field('module_description');
						?> 
							<div class="module">
								<h3 class="module-description" id="module-<?php echo get_row_index();?>"><?php echo $module_name;?></h3>
								<div class="long-description"><?php echo $module_description;?></div>	
							</div>
						<?php endwhile; ?>
						<?php else: ?>
							<p>No modules entered.</p>
					<?php endif; ?>				
				</div>
				<!--END LONG DESCRIPTION-->
				<!--COURSE OUTLINE-->
				<div class="outline holder" id="outline">					
					<h2>Course Outline</h2>
					<div class="course-outline">
						<?php echo aln_course_outline();?>
					</div>
					<?php echo aln_course_outline_link();?>
				</div>
				<!--END COURSE OUTLINE-->
				<!--COURSE DESIGN STATEMENT-->
				<div class="design holder" id="design-statement">
					<?php 
						$course_design = get_field('course_design_statement');
						echo '<h2>Course Design Statements</h2>';
						if( $course_design ): ?>
							<ul>
							    <?php foreach( $course_design as $statement ): ?>
							        <li>✓ <?php echo $statement; ?></li>
							    <?php endforeach; ?>
							</ul>
							<?php else:?>
								<p>No design statements given.</p>
						<?php endif; ?>
				
				</div>
				<!--END COURSE DESIGN STATEMENT-->
				<!--COURSE INSTRUCTOR-->
				<div class="instructor holder" id="instructor">					
					<h2>Instructor</h2>
					<div class="row">
						<div class="col-md-4">
							<img src="<?php echo aln_instructor_image();?>" class="img-fluid instructor-bio-img" alt="Biography picture for <?php echo aln_instructor_name();?>" >
						</div>
						<div class="col-md-8">
						<h3><?php echo aln_instructor_name();?></h3>
						<p><?php echo aln_instructor_bio();?></p>
						</div>
					</div>
				</div>
				<!--END INSTRUCTOR-->
			<!--ARTEFACT REPEATER-->	
					<?php if( have_rows('course_artefacts') ): ?>
						<div class="artefact-holder holder" id="artefacts">
							<h2>Course Artefacts</h2>
		
							<?php while( have_rows('course_artefacts') ): the_row(); 
								// vars
								$artefact_title = get_sub_field('artefact_title');
								$artefact_url = get_sub_field('artefact_link');
								$artefact_desc = get_sub_field('artefact_description');

								?>
								<div class="d-flex flex-row artefact-row">								
										<?php if( $artefact_url ): ?>
											<?php echo '<a href="'.$artefact_url . '" class="artefact-link">';?>
										<?php endif; ?>
										<?php if( $artefact_title ): ?>
											<?php echo $artefact_title;?>
										<?php endif; ?>
										<?php if( $artefact_url ): ?>
											<?php echo '</a>';?>
										<?php endif; ?>
										<?php if( $artefact_desc ): ?>
											<?php echo '<span class="artefact-desc">' . $artefact_desc . '</span>';?>
										<?php endif; ?>
								</div>
										

							<?php endwhile; ?>
						</div>
						<?php endif; ?>
				<!--END ARTEFACT REPEATER-->
				
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
