<div class="mx-single-table-item-wrap">

    <h1><?php echo __( 'Edit Table Item', 'mxalfwp-domain' ); ?></h1>

    <a href="<?php echo admin_url( 'admin.php?page=' . MXALFWP_MAIN_MENU_SLUG ); ?>">Go Back</a>

    <div class="mxalfwpmx_block_wrap">

        <form id="mxalfwp_form_update" class="mx-settings" method="post" action="">

            <input type="hidden" id="mxalfwp_id" name="mxalfwp_id" value="<?php echo $data->id; ?>" />

            <h2>This form is connected to this plugin's DB table</h2>

            <div>
                <label for="mxalfwp_title">Link</label>
                <br>
                <input type="text" name="mxalfwp_title" id="mxalfwp_title" value="<?php echo $data->link; ?>" />
            </div>
            <br>
            <div>
                <label for="mxalfwp_mx_description">Description</label>
                <br>
                <textarea name="mxalfwp_mx_description" id="mxalfwp_mx_description"></textarea>
            </div>

            <p class="mx-submit_button_wrap">
                <input type="hidden" id="mxalfwp_wpnonce" name="mxalfwp_wpnonce" value="<?php echo wp_create_nonce('mxalfwp_nonce_request'); ?>" />
                <input class="button-primary" type="submit" name="mxalfwp_submit" value="Save" />
            </p>

        </form>

    </div>

</div>