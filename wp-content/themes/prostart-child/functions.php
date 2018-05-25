<?php
/**
 * Child-Theme functions and definitions
 */

function prostart_child_scripts() {
    wp_enqueue_style( 'prostart-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'prostart_child_scripts' );
 
?>