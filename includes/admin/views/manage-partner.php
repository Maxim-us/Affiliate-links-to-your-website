<div class="mxalfwp-sub-page-text-wrap">

    <!--  -->
    <div class="mxalfwp-page-breadcrumb mxalfwp-bg-white">
        <div class="mxalfwp-row mxalfwp-align-items-center">
            <div class="mxalfwp-col-lg-3 mxalfwp-col-md-4 mxalfwp-col-sm-4 mxalfwp-col-xs-12">
                <h4 class="mxalfwp-page-title">
                    <a href="<?php echo admin_url('admin.php?page=' . MXALFWP_MAIN_MENU_SLUG); ?>" class="mxalfwp-common-link"><i class="fa fa-chevron-left" aria-hidden="true"></i> All links</a> |

                    <?php echo __('Page Views', 'mxalfwp-domain'); ?>
                </h4>
            </div>
            <div class="mxalfwp-col-lg-9 mxalfwp-col-sm-8 mxalfwp-col-md-8 mxalfwp-col-xs-12">

                <div class="mxalfwp-d-md-flex">
                    <ol class="mxalfwp-breadcrumb mxalfwp-ms-auto">
                        <li class="mxalfwp-big-text">
                            <a href="<?php echo admin_url('admin.php?page=' . MXALFWP_MAIN_MENU_SLUG . '&user_id=' . $data['userData']['user_id']); ?>"><?php echo __('All Links Of: ', 'mxalfwp-domain') . $data['userData']['user_name']; ?></a>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- Section title -->
    <div class="mxalfwp-row">
        <div class="mxalfwp-col-md-12">
            <h3 class="mxalfwp-page-title mxalfwp-mt-30">
                <?php echo __('Personal Data', 'mxalfwp-domain'); ?>
            </h3>
        </div>
    </div>

    <!-- Section -->
    <div class="mxalfwp-row mxalfwp-justify-content-center mxalfwp-mt-15">

        <!-- User Name -->
        <div class="mxalfwp-col-lg-4 mxalfwp-col-md-12">
            <div class="mxalfwp-white-box mxalfwp-analytics-info mxalfwp-text-center">
                <div class="mxalfwp-icon-box">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </div>
                <h5 class="mxalfwp-box-title mxalfwp-mt-15">
                    <?php echo __('Partner', 'mxalfwp-domain'); ?>
                </h5>
                <div class="mxalfwp-counter mxalfwp-mb-15">
                    <a href="<?php echo admin_url('user-edit.php?user_id=' . $data['userData']['user_id']); ?>" class="mxalfwp-common-link" target="_blank"><?php echo $data['userData']['user_name']; ?> (#<?php echo $data['userData']['user_id']; ?>)</a>
                </div>
            </div>
        </div>

        <!-- Number of Active links -->
        <div class="mxalfwp-col-lg-4 mxalfwp-col-md-12">
            <div class="mxalfwp-white-box mxalfwp-analytics-info mxalfwp-text-center">
                <div class="mxalfwp-icon-box">
                    <i class="fa fa-link" aria-hidden="true"></i>
                </div>
                <h5 class="mxalfwp-box-title mxalfwp-mt-15">
                    <?php echo __('Number of Active links', 'mxalfwp-domain'); ?>
                </h5>
                <div class="mxalfwp-counter mxalfwp-mb-15">
                    <?php echo $data['activeLinks']; ?>
                </div>
            </div>
        </div>

        <!-- Number of Trash links -->
        <div class="mxalfwp-col-lg-4 mxalfwp-col-md-12">
            <div class="mxalfwp-white-box mxalfwp-analytics-info mxalfwp-text-center">
                <div class="mxalfwp-icon-box ">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
                <h5 class="mxalfwp-box-title mxalfwp-mt-15">
                    <?php echo __('Number of Trash links', 'mxalfwp-domain'); ?>
                </h5>
                <div class="mxalfwp-counter mxalfwp-mb-15">
                    <?php echo $data['trashLinks']; ?>
                </div>
            </div>
        </div>

        <!-- Visited Pages -->
        <div class="mxalfwp-col-lg-4 mxalfwp-col-md-12">
            <div class="mxalfwp-white-box mxalfwp-analytics-info mxalfwp-text-center">
                <div class="mxalfwp-icon-box">
                    <i class="fa fa-files-o" aria-hidden="true"></i>
                </div>
                <h5 class="mxalfwp-box-title mxalfwp-mt-15">
                    <?php echo __('Visited Pages', 'mxalfwp-domain'); ?>
                </h5>
                
                <div class="mxalfwp-counter mxalfwp-mb-15">
                    <?php echo $data['trashPages'] + $data['trashPages']; ?>
                </div>

                <small><?php echo __('The number of pages that users have visited through the affiliate links of this partner', 'mxalfwp-domain'); ?></small>

            </div>
        </div>

        <!-- Views -->
        <div class="mxalfwp-col-lg-4 mxalfwp-col-md-12">
            <div class="mxalfwp-white-box mxalfwp-analytics-info mxalfwp-text-center">
                <div class="mxalfwp-icon-box">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
                <h5 class="mxalfwp-box-title mxalfwp-mt-15">
                    <?php echo __('Page Views', 'mxalfwp-domain'); ?>
                </h5>

                
                <div class="mxalfwp-counter mxalfwp-mb-15">
                    <?php echo $data['activePageViews'] + $data['trashPageViews']; ?>
                </div>

                <small><?php echo __('Total number of page views via the affiliate links of this partner', 'mxalfwp-domain'); ?></small>

            </div>
        </div>

        <!-- Bought -->
        <div class="mxalfwp-col-lg-4 mxalfwp-col-md-12">
            <div class="mxalfwp-white-box mxalfwp-analytics-info mxalfwp-text-center">
                <div class="mxalfwp-icon-box">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <h5 class="mxalfwp-box-title mxalfwp-mt-15">
                    <?php echo __('Bought', 'mxalfwp-domain'); ?>
                </h5>
                
                <div class="mxalfwp-counter mxalfwp-mb-15">
                    <?php echo $data['bought']; ?>
                </div>

                <small><?php echo __('How many products have been purchased through the affiliate links of this partner', 'mxalfwp-domain'); ?></small>

            </div>
        </div>

        <!-- Earned -->
        <div class="mxalfwp-col-lg-4 mxalfwp-col-md-12">
            <div class="mxalfwp-white-box mxalfwp-analytics-info mxalfwp-text-center">
                <div class="mxalfwp-icon-box">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
                <h5 class="mxalfwp-box-title mxalfwp-mt-15">
                    <?php echo __('Earned', 'mxalfwp-domain'); ?>
                </h5>
                
                <div class="mxalfwp-counter mxalfwp-mb-15">
                    $<?php echo $data['earned']; ?>
                </div>

                <small><?php echo __('How much did the partner earn', 'mxalfwp-domain'); ?></small>

            </div>
        </div>

        <!-- Paid -->
        <div class="mxalfwp-col-lg-4 mxalfwp-col-md-12">
            <div class="mxalfwp-white-box mxalfwp-analytics-info mxalfwp-text-center">
                <div class="mxalfwp-icon-box">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                </div>
                <h5 class="mxalfwp-box-title mxalfwp-mt-15">
                    <?php echo __('Paid', 'mxalfwp-domain'); ?>
                </h5>
                
                <form class="mxalfwp-counter mxalfwp-mb-15 mxalfwp-payment-form">
                    <div class="mxalfwp-payment-input">
                        <label for="mxalfwp_payment_partner">$</label>
                        <input type="number" id="mxalfwp_payment_partner" name="mxalfwp_payment_partner" step="0.01" value="<?php echo $data['paid']; ?>" />
                    </div>
                    <div>
                        <button type="submit" class="mxalfwp-btn mxalfwp-btn-danger
                            mxalfwp-d-md-block
                            mxalfwp-pull-right
                            mxalfwp-margin-auto
                            mxalfwp-mt-15
                            mxalfwp-hidden-xs mxalfwp-hidden-sm
                            mxalfwp-waves-effect mxalfwp-waves-light
                            mxalfwp-text-white"
                        >
                            <?php echo __('Change Amount', 'mxalfwp-domain'); ?>
                        </button>
                    </div>
                </form>

                <small><?php echo __('How much did you pay your partner', 'mxalfwp-domain'); ?></small>

            </div>
        </div>
    </div>
</div>