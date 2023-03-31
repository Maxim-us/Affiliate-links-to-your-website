<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Main page Model
 */
class MXALFWPMainAdminModel extends MXALFWPModel
{

    /*
    * Observe function
    */
    public static function wpAjax()
    {

        add_action( 'wp_ajax_mxalfwp_update', ['MXALFWPMainAdminModel', 'prepareUpdateDatabaseColumn'], 10, 1 );
        add_action( 'wp_ajax_mxalfwp_create_item', ['MXALFWPMainAdminModel', 'prepareItemCreation'], 10, 1 );
        add_action( 'wp_ajax_mxalfwp_bulk_actions', ['MXALFWPMainAdminModel', 'prepareBulkActions'], 10 );

        // Settings page
        add_action( 'wp_ajax_mxalfwp_save_settings', ['MXALFWPMainAdminModel', 'prepareSaveSettings'], 10 );

        // pay a partner
        add_action( 'wp_ajax_mxalfwp_pay_partner', ['MXALFWPMainAdminModel', 'preparePayPartner'], 10 );        
        
    }

    /*
    * Pay Partner
    */
    public static function preparePayPartner()
    {

        // Checked POST nonce is not empty
        if (empty($_POST['nonce'])) wp_die( '0' );

        // Checked or nonce match
        if (wp_verify_nonce($_POST['nonce'], 'mxalfwp_nonce_request_admin')) {

            var_dump($_POST);

            // number validation

            // check if the number is not less than saved "paid"

            // check if the number is not more than saved "paid"

            // save changes

        }

        wp_die();

    }

    /*
    * Settings
    */
    public static function prepareSaveSettings()
    {

        // Checked POST nonce is not empty
        if (empty($_POST['nonce'])) wp_die( '0' );

        // Checked or nonce match
        if (wp_verify_nonce($_POST['nonce'], 'mxalfwp_nonce_request_admin')) {

            $updated = update_option('mxalfwp_default_percent',floatval($_POST['percent']));

            $responce = [
                'status' => 'success',
                'message' => __('Settings updated!', 'mxalfwp-domain')
            ];

            if( ! $updated ) {

                $responce = [
                    'status' => 'failed',
                    'message' => __('Something went wrong! Did you make changes?', 'mxalfwp-domain')
                ];

            }

            echo json_encode($responce);

        }

        wp_die();

    }

    /*
    * Prepare to bulk actions
    */
    public static function prepareBulkActions()
    {
        
        // Checked POST nonce is not empty
        if (empty($_POST['nonce'])) wp_die( '0' );

        // Checked or nonce match
        if (wp_verify_nonce($_POST['nonce'], 'bulk-mxalfwp_plural')) {

            // delete
            if ($_POST['bulk_action']  == 'delete') {

                if (!current_user_can('edit_posts')) return;

                self::actionDelete( $_POST['ids'] );
                
                return;

            }
            
            // restore
            if ($_POST['bulk_action']  == 'restore') {

                if (!current_user_can('edit_posts')) return;

                self::actionRestore( $_POST['ids'] );
                
                return;

            }

            // move to trash
            if ($_POST['bulk_action']  == 'trash') {

                if (!current_user_can('edit_posts')) return;

                self::actionTrash( $_POST['ids'] );
                
                return;

            }

        }

        wp_die();

    }

    /**
     * Handle bulk actions 
     */
    // Delete permanently
    public static function actionDelete( $ids )
    {

        foreach ($ids as $id) {
            ( new self )->deletePermanently( $id );
        }

        return;

    }

    // Restore
    public static function actionRestore( $ids )
    {

        foreach ($ids as $id) {
            ( new self )->restoreItem( $id );
        }

        return;

    }

    // Move to Trash
    public static function actionTrash( $ids )
    {

        foreach ($ids as $id) {
            ( new self )->moveToTrash( $id );
        }

        return;

    }

    /*
    * Prepare item creation
    */
    public static function prepareItemCreation()
    {

        // Checked POST nonce is not empty
        if (empty($_POST['nonce'])) wp_die( '0' );

        // Checked or nonce match
        if (wp_verify_nonce($_POST['nonce'], 'mxalfwp_nonce_request')) {

            // Create item
            $title = sanitize_text_field( $_POST['title'] );
            $description = esc_html( $_POST['description'] );

            $data = [
                'title' => $title,
                'description' => $description,
            ];

            self::createItem( $data );
        }

        wp_die();

    }

    // Create item
    public static function createItem( $data )
    {

        global $wpdb;
        
        $tableName = $wpdb->prefix . MXALFWP_TABLE_SLUG;
        
        $created = $wpdb->insert(
            
            $tableName, 
            [
                'title' => $data['title'],
                'description' => $data['description'],
            ],
            [
                '%s',
                '%s',
            ]

        );

        echo $created;

    }

    /*
    * Prepare item updating
    */
    public static function prepareUpdateDatabaseColumn()
    {

        // Checked POST nonce is not empty
        if (empty($_POST['nonce'])) wp_die( '0' );

        // Checked or nonce match
        if (wp_verify_nonce($_POST['nonce'], 'mxalfwp_nonce_request')) {

            // Update data
            $id = sanitize_text_field( $_POST['id'] );
            $title = sanitize_text_field( $_POST['title'] );
            $description = esc_html( $_POST['description'] );

            $data = [
                'id'          => $id,
                'title'       => $title,
                'description' => $description,
            ];

            self::updateDatabaseColumn( $data );
        }

        wp_die();

    }

    // Update item
    public static function updateDatabaseColumn( $data )
    {

        global $wpdb;
        
        $tableName = $wpdb->prefix . MXALFWP_TABLE_SLUG;

        $wpdb->update(

            $tableName,
            [
                'title'       => $data['title'],
                'description' => $data['description'],
            ],
            [
                'id'          => $data['id']
            ],
            [
                '%s',
                '%s',
            ]

        );

    }

    /*
    * Actions
    */
    // restore item
    public function restoreItem( $id )
    {

        global $wpdb;
        
        $tableName = $wpdb->prefix . MXALFWP_TABLE_SLUG;

        $wpdb->update(

            $tableName,
            [
                'status' => 'active',
            ],
            [
                'id'     => $id
            ],
            [
                '%s',
            ]

        );

    }
    // move to trash
    public function moveToTrash( $id )
    {

        global $wpdb;
        
        $tableName = $wpdb->prefix . MXALFWP_TABLE_SLUG;

        $wpdb->update(

            $tableName,
            [
                'status' => 'trash',
            ],
            [
                'id'     => $id
            ],
            [
                '%s',
            ]

        );

    }

    // delete permanently
    public function deletePermanently( $id )
    {

        // global $wpdb;

        // $tableName = $wpdb->prefix . MXALFWP_TABLE_SLUG;

        // $wpdb->delete( 
        //     $tableName, 
        //     [
        //         'id' => $id
        //     ], 
        //     [ 
        //         '%d'
        //     ] 
        // );

    }

}
