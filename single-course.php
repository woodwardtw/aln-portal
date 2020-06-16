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
						<div class="date-holder holder table-responsive" id="dates">
							<h2>Course Dates</h2>
							<table class="table">
									  <thead>
									    <tr>
									      <th scope="col">Registration Start Date</th>
									      <th scope="col">Registration End Date</th>
									      <th scope="col">Course Start Date</th>
									      <th scope="col">Course End Date</th>
									    </tr>
									  </thead>
									  <tbody>
		
							<?php while( have_rows('dates') ): the_row(); 
								// vars
								$reg_start = get_sub_field('registration_start_date');
								$reg_end = get_sub_field('registration_end_date');
								$course_start = get_sub_field('course_start_date');
								$course_end = get_sub_field('course_end_date');

								?>
								
									    <tr>
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
							 </tbody>
							</table>
						</div>
						<?php endif; ?>
				<!--END DATE REPEATER-->
				<!--SHORT DESCRIPTION-->
				<div class="short-holder holder" id="short-desc">	
                    <?php 
						$short_course_description = get_field('short_course_description');
						echo '<h2>Short Course Description</h2><div class="short-description">' . $short_course_description . '</div>';
					;?>
				</div>
				<!--END SHORT DESCRIPTION-->
				<!--LONG DESCRIPTION-->
				<div class="long-holder holder" id="full-desc">
					<?php if( have_rows('long_course_description') ): ?>
						<h2>Long Course Description</h2>
						<?php while( have_rows('long_course_description') ): the_row();
							$module_name = get_sub_field('module_name');
							$module_description = get_sub_field('module_description');
						?> 
							<div class="module">
								<h3 class="module-description"><?php echo $module_name;?></h3>
								<div class="long-description"><?php echo $module_description;?></div>	
							</div>
						<?php endwhile; ?>
					<?php endif; ?>				
				</div>
				<!--END LONG DESCRIPTION-->
				<!--COURSE OUTLINE-->
				<div class="outline holder" id="outline">
					<?php 
						$course_outline = get_field('course_outline')['course_outline'];
						$course_link = get_field('course_outline')['full_course_outline_link'];						
						echo '<h2>Course Outline</h2><div class="course-outline">' . $course_outline . '</div>';
						echo '<a href="' . $course_link .'" class="btn btn-primary">See the full outline</a>';
					;?>
				</div>
				<!--END COURSE OUTLINE-->
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
				<!--END DATE REPEATER-->

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
