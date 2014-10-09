<?php

function cheffism_add_meta_boxes() {
    add_meta_box( 'page-schema', 'Schema.org', 'cheffism_page_schemas', 'page' );
}
add_action( 'add_meta_boxes', 'cheffism_add_meta_boxes' );

function cheffism_page_schemas( $post ) {

    wp_nonce_field( 'cheffism_schema_meta_box', 'cheffism_schema_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_cheffism_schema_type', true );

    echo '<label for="cheffism_schema_type">';
    _e( 'Enter this page\'s Schema.org type', 'cheffism' );
    echo '</label> ';
    echo '<input type="text" id="cheffism_schema_type" name="cheffism_schema_type" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function cheffism_save_schema_meta_box( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['cheffism_schema_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['cheffism_schema_meta_box_nonce'], 'cheffism_schema_meta_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
    // Make sure that it is set.
    if ( ! isset( $_POST['cheffism_schema_type'] ) ) {
        return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['cheffism_schema_type'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_cheffism_schema_type', $my_data );
}
add_action( 'save_post', 'cheffism_save_schema_meta_box' );