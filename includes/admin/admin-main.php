<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class MXALFWPAdminMain
{

    // list of model names used in the plugin
    public $modelsCollection = [
        'MXALFWPMainAdminModel'
    ];    

    /*
    * Additional classes
    */
    public function additionalClasses()
    {

        // enqueue_scripts class
        mxalfwpRequireClassFileAdmin( 'enqueue-scripts.php' );

        MXALFWPEnqueueScripts::registerScripts();

        // // mx metaboxes class
        // mxalfwpRequireClassFileAdmin( 'metabox.php' );

        // mxalfwpRequireClassFileAdmin( 'metabox-image-upload.php' );

        // MXALFWPMetaboxesImageUpload::registerScripts();
        
        // // CPT class
        // mxalfwpRequireClassFileAdmin( 'cpt.php' );

        // MXALFWPCPTGenerator::createCPT();

        // Affiliate links tables
        mxalfwpRequireClassFileAdmin( 'links-table.php' );
        mxalfwpRequireClassFileAdmin( 'analytics-pages-table.php' );
        mxalfwpRequireClassFileAdmin( 'page-views-table.php' );

    }

    /*
    * Integration
    */
    public function integration()
    {

        mxalfwpRequireClassFileAdmin( 'integration/abstract.php' );


        // woocommerce
        mxalfwpRequireClassFileAdmin( 'integration/woocommerce.php' );


    }

    /*
    * Models Connection
    */
    public function modelsCollection()
    {

        // require model file
        foreach ($this->modelsCollection as $model) {            
            mxalfwpUseModel( $model );
        }        

    }

    /**
    * registration ajax actions
    */
    public function registrationAjaxActions()
    {

        // ajax requests to main page
        MXALFWPMainAdminModel::wpAjax();

    }

    /*
    * Routes collection
    */
    public function routesCollection()
    {
 
        // main menu item
        MXALFWPRoute::get( 'MXALFWPMainAdminController', 'index', '', [
            'page_title' => 'Affiliate Links',
            'menu_title' => 'Affiliate Links'
        ] );

            // Links Analytics
            MXALFWPRoute::get( 'MXALFWPMainAdminController', 'linksAnalytics', 'NULL', [
                'page_title' => 'Links Analytics',
            ], MXALFWP_SINGLE_TABLE_ITEM_MENU );

            // // single table item
            // MXALFWPRoute::get( 'MXALFWPMainAdminController', 'createTableItem', 'NULL', [
            //     'page_title' => 'Create Table Item',
            // ], MXALFWP_CREATE_TABLE_ITEM_MENU );

        // sub menu item
        MXALFWPRoute::get( 'MXALFWPMainAdminController', 'submenu', '', [
            'page_title' => 'Settings',
            'menu_title' => 'Settings'
        ], 'mxalfwp-setting' );

        // hide menu item
        MXALFWPRoute::get( 'MXALFWPMainAdminController', 'visitedPageDetails', 'NULL', [
            'page_title' => 'Visited Page Details',
        ], 'mxalfwp-visited-page-details' );

        // hide menu item
        MXALFWPRoute::get( 'MXALFWPMainAdminController', 'managePartner', 'NULL', [
            'page_title' => 'Partner',
        ], 'mxalfwp-manage-partner' );        

        // sub settings menu item
        MXALFWPRoute::get( 'MXALFWPMainAdminController', 'settingsMenuItemAction', 'NULL', [
            'menu_title' => 'Settings Item',
            'page_title' => 'Title of settings page'
        ], 'settings_menu_item', true );

    }

}

// Initialize
$adminClassInstance = new MXALFWPAdminMain();

// include classes
$adminClassInstance->additionalClasses();

// integration
$adminClassInstance->integration();

// include models
$adminClassInstance->modelsCollection();

// ajax requests
$adminClassInstance->registrationAjaxActions();

// include controllers
$adminClassInstance->routesCollection();