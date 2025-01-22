<?php 
namespace capweb;

add_filter( 'rwmb_meta_boxes', __NAMESPACE__ . '\testimonial_manager' );

function testimonial_manager( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'              => __( 'Testimonial Fields', 'wolfcreek' ),
        'id'                 => 'testimonial-fields',
        'post_types'         => ['testimonial'],
        'closed'             => false,
        'revision'           => false,
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'             => [
            [
                'name'              => __( 'Testimonial Title', 'wolfcreek' ),
                'id'                => $prefix . 'testimonial_title',
                'type'              => 'text',
                'required'          => false,
                'disabled'          => false,
                'readonly'          => false,
                'clone'             => false,
                'clone_empty_start' => false,
                'hide_from_rest'    => false,
                'hide_from_front'   => false,
                'limit_type'        => 'character',
            ],
            [
                'name' => esc_html__( 'Yurt Rating', 'wolfcreek' ),
                'id'   => $prefix . 'rating',
                'type' => 'rating',
            ],
            [
                'name'              => __( 'Testimonial text', 'wolfcreek' ),
                'id'                => $prefix . 'testimonial_text',
                'type'              => 'textarea',
                'required'          => false,
                'disabled'          => false,
                'readonly'          => false,
                'clone'             => false,
                'clone_empty_start' => false,
                'hide_from_rest'    => false,
                'hide_from_front'   => false,
                'limit_type'        => 'character',
            ],
            [
                'name'              => __( 'Attribution', 'wolfcreek' ),
                'id'                => $prefix . 'attribution',
                'type'              => 'text',
                'desc'              => __( 'Source of the testimonial. Either a person or a website name. Such as \'TripAdvisor\'.', 'wolfcreek' ),
                'required'          => false,
                'disabled'          => false,
                'readonly'          => false,
                'clone'             => false,
                'clone_empty_start' => false,
                'hide_from_rest'    => false,
                'hide_from_front'   => false,
                'limit_type'        => 'character',
            ],
        ],
    ];

    return $meta_boxes;
}

function testimonial_shortcode_handler($atts, $content, $tag ) {
    $atts = shortcode_atts( array(
        'post_id' => get_the_ID(),
    ), $atts, $tag );

    $rating = rwmb_meta( 'rating', '', $atts['post_id'] );

    $output = '<div class="star-rating">';
    if ( 1 <= $rating ) { // Only output if rating greater than 0
        for ( $i = 1; $i <= 5; $i++ ) {
            $output .= '<span class="dashicons dashicons-star-' . ( $i <= $rating ? 'filled' : 'empty' ) . '"></span>';
        }
    }
    $output .= '</div>';

    return $output;

}
function shortcodes_init() {
    add_shortcode('showrating', __NAMESPACE__ . '\testimonial_shortcode_handler');
}
add_action('init', __NAMESPACE__ . '\shortcodes_init');
