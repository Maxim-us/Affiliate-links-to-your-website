<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class MXALFWPIntegrationWoocommerce
{

    public function registerActions()
    {

        // if woocommerce doesn't activeate = return
        if (!in_array('woocommerce/woocommerce.php', get_option('active_plugins'), true)) {
            add_action('mxalfwp_affiliate_links_before_table', [$this, 'woocommerceRequiredMessage']);
            return;
        }

        // orders status changes
        add_action('woocommerce_order_status_changed', [$this, 'manageOrders'], 10, 3);

        // show data for admin
		add_action( 'woocommerce_admin_order_data_after_order_details', [$this, 'displayPartnerInOrder'] );

    }

    public function displayPartnerInOrder($order)
    { 

        $orderData = mxalfwpGetOrderById($order->get_id());

        if(!$orderData) return;

        $user = get_user_by( 'id', $orderData['user_id'] );

?>
        <br>
        <p class="form-field form-field-wide wc-affiliate-partner">

            <?php echo __('Affiliate link by ', 'mxalfwp-domain'); ?>
            <a href="<?php echo admin_url('admin.php?page=mxalfwp-manage-partner&user_id=' . $orderData['user_id']); ?>" class="mxalfwp-common-link" target="_blank"><?php echo $user->display_name;?></a>

        </p>

<?php
    }

    public function woocommerceRequiredMessage()
    { ?>
        <div class="mxalfwp-p20 mxalfwp-danger-box mxalfwp-analytics-info mxalfwp-text-center">
            <h2 class="mxalfwp-page-title"><?php echo __('Please install and activeate WooCommerce plugin', 'mxalfwp-domain'); ?></h2>
        </div>
<?php }

    public function manageOrders($id, $previous_status, $next_status)
    {

        // if no cookies
        if (!isset($_COOKIE['mxalfwpLinkIdentifier'])) return;

        // get affiliate link by identifier
        $inst       = new MXALFWPMainAdminModel();

        $linkKey    = sanitize_text_field($_COOKIE['mxalfwpLinkIdentifier']);

        $and        = "AND link_key = '$linkKey' AND status = 'active'";

        $linkData   = $inst->getRow(NULL, 1, 1, $and);

        if ($linkData == NULL) return;

        $orderWC    = wc_get_order($id);

        $amount     = $orderWC->get_total();

        // looking for in orders table
        $orderData  = $inst->getRow(MXALFWP_ORDERS_TABLE_SLUG, 'order_id', intval($id));

        // date
        $date = date('Y-m-d H:i:s');

        // create
        if ($orderData == NULL) {

            $insert = $inst->insertRow(
                MXALFWP_ORDERS_TABLE_SLUG,
                [
                    'order_id'   => $id,
                    'user_id'    => $linkData->user_id,
                    'link_id'    => $linkData->id,
                    'status'     => $next_status,
                    'amount'     => $amount,
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                [
                    '%d',
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                ]
            );
            return $insert;
        } else {

            // update
            $updated = $inst->updateRow(
                MXALFWP_ORDERS_TABLE_SLUG,
                'order_id',
                intval($id),
                [
                    'status'     => $next_status,
                    'amount'     => $amount,
                    'updated_at' => $date,
                ],
                [
                    '%s',
                    '%d',
                    '%s',
                ]
            );

            return $updated;
        }
    }
}

(new MXALFWPIntegrationWoocommerce)->registerActions();
