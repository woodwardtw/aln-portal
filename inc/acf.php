<?php
/**
 * ACF Functions and CPTs
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


//from https://whiteleydesigns.com/modify-post-title-post-content-labels-front-end-acf-form/
// Modify ACF Form Label for Post Title Field
function aln_post_title_acf_name( $field ) {
   
    $field['label'] = 'Course Name';
    return $field;
}
add_filter('acf/load_field/name=_post_title', 'aln_post_title_acf_name');

function aln_registration_fee (){
    if( get_field('registration_fee')){
        $cost = get_field('registration_fee');
        return '$' . number_format($cost, 2) . ' +GST' ;
    } else {
        return 'No fee indicated.';
    }
}

function aln_university(){
    if (get_field('')){
        return get_field('')['university'][0]->name;
    } else {
        return 'No university given.';
    }
}

function aln_engagement_hours(){
    if(get_field("learner_engagement_hours")){
        return get_field("learner_engagement_hours") . ' hours';
    } else {
        return 'No hours indicated.';
    }
}

function aln_registration_link(){
     if(get_field('psi_registration_page_link')){
        return '<a href="' . get_field('psi_registration_page_link') . '" aria-label="Go to the PSI registration page.">Click here to register</a>' ;
    } else {
        return FALSE; //'No link given This is essential for the marketing of your course.'
    }
}

function aln_registration_contact(){
    $title = get_the_title();
    $name = 'N/A';
    $phone = 'N/A';
    $email = 'N/A';
     if (get_field('')["course_contact_name"] != null || get_field('')["course_contact_email"]){
        if (get_field('')["course_contact_name"]){
            $name = get_field('')["course_contact_name"];
        }
        if (get_field('')["course_contact_email"]){
            $email = get_field('')["course_contact_email"];
        } 
        if (get_field('')["course_contact_phone"]){            
         $phone = get_field('')["course_contact_phone"];
        }
        return "Name: {$name}<br>Phone: {$phone}<br>Email: <a href='mailto:{$email}?subject={$title} Course Inquiry'>{$email}</a>";
     }
}

function aln_short_course_description(){
    $description = get_field('short_course_description');
    if ($description){
        return $description;
    } else {
        return 'No description given.';
    }
}

function aln_course_outline(){
    if(get_field('course_outline')['course_outline']){
        return $course_outline = get_field('course_outline')['course_outline'];     
    } else {
        return "No course outline given.";
    }
}

function aln_course_outline_link(){
     $course_link = get_field('course_outline')['full_course_outline_link'];  
     if($course_link){
        return '<a href="' . $course_link . '" class="btn btn-primary">See the full outline</a>';
     } else {
        return 'No link given.';
     }
}

function aln_instructor_image(){
    if(get_field('instructor')['instructor_image']){
       return $instructor_image = get_field('instructor')['instructor_image']['sizes']['thumbnail'];
    }
    else {
        return $instructor_image = get_template_directory_uri() . '/imgs/mystery.png' ;//symbol.jpg
    }
}

function aln_instructor_name(){
    if(get_field('instructor')['instructor_name']){
        return get_field('instructor')['instructor_name'];
    } else {
        return 'Mystery Instructor';
    }
}

function aln_instructor_bio(){
    if(get_field('instructor')['instructor_biography']){
        return get_field('instructor')['instructor_biography'];
    } else {
        return 'Please enter an instructor biography. Understanding who is teaching a course is a key element in marketing the course.';
    }
}


//ACF SAVE and LOAD JSON
add_filter('acf/settings/save_json', 'alt_ee_json_save_point');
 
function alt_ee_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    // return
    return $path;
    
}


add_filter('acf/settings/load_json', 'alt_ee_json_load_point');

function alt_ee_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory()  . '/acf-json';
    
    
    // return
    return $paths;
    
}



