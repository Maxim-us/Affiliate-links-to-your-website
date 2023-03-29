<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class MXALFWPMainAdminController extends MXALFWPController
{

    protected $modelInstance;

    public function __construct()
    {

        $this->modelInstance = new MXALFWPMainAdminModel();
        
    }
    
    public function index()
    {

        return new MXALFWPMxView( 'main-page' );

    }

    public function submenu()
    {

        return new MXALFWPMxView( 'sub-page' );

    }

    public function hidemenu()
    {

        return new MXALFWPMxView( 'hidemenu-page' );

    }

    public function settingsMenuItemAction()
    {

        return new MXALFWPMxView( 'settings-page' );

    }

    public function singleTableItem()
    {

        // delete action
        $deleteId = isset( $_GET['delete'] ) ? trim( sanitize_text_field( $_GET['delete'] ) ) : false;
        
        if ($deleteId) {

            if (isset($_GET['mxalfwp_nonce']) || wp_verify_nonce($_GET['mxalfwp_nonce'], 'delete')) {

                $this->modelInstance->deletePermanently( $deleteId );

            }

            mxalfwpAdminRedirect( admin_url( 'admin.php?page=' . MXALFWP_MAIN_MENU_SLUG . '&item_status=trash' ) );

            return;

        }

        // restore action
        $restore_id = isset( $_GET['restore'] ) ? trim( sanitize_text_field( $_GET['restore'] ) ) : false;
        
        if ($restore_id) {

            if (isset( $_GET['mxalfwp_nonce']) || wp_verify_nonce($_GET['mxalfwp_nonce'], 'restore')) {

                $this->modelInstance->restoreItem( $restore_id );

            }

            mxalfwpAdminRedirect( admin_url( 'admin.php?page=' . MXALFWP_MAIN_MENU_SLUG . '&item_status=trash' ) );

            return;

        }

        // trash action
        $trash_id = isset( $_GET['trash'] ) ? trim( sanitize_text_field( $_GET['trash'] ) ) : false;

        if ($trash_id) {

            if (isset($_GET['mxalfwp_nonce']) || wp_verify_nonce($_GET['mxalfwp_nonce'], 'trash')) {

                $this->modelInstance->moveToTrash( $trash_id );

            }

            mxalfwpAdminRedirect( admin_url( 'admin.php?page=' . MXALFWP_MAIN_MENU_SLUG ) );

            return;

        }

        // edit action
        $item_id = isset( $_GET['link-details'] ) ? trim( sanitize_text_field( $_GET['link-details'] ) ) : 0;
        
        $data = $this->modelInstance->getRow( NULL, 'id', intval( $item_id ) );

        if ($data == NULL) {
            if (!isset( $_SERVER['HTTP_REFERER'] ) || $_SERVER['HTTP_REFERER'] == NULL) {
                mxalfwpAdminRedirect( admin_url( 'admin.php?page=' . MXALFWP_MAIN_MENU_SLUG ) );
            } else {
                mxalfwpAdminRedirect( $_SERVER['HTTP_REFERER'] );
            }
            
            return;

        }
        
        return new MXALFWPMxView( 'single-table-item', $data );

    }        

    // create table item
    public function createTableItem() {

        return new MXALFWPMxView( 'create-table-item' );

    }

}
