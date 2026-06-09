<div class="wslu-onboard-main-header">
    <h1 class="wslu-onboard-main-header--title"><strong><?php

echo esc_html__('Take your website to the next level', 'wp-social'); ?></strong></h1>
    <p class="wslu-onboard-main-header--description"><?php echo esc_html__('A fleet of plugins with all types of features you will need for WordPress.', 'wp-social'); ?></p>
</div>

<div class="wslu-onboard-plugin-list">
    <div class="attr-row">
        <?php
        $pluginStatus =  \WP_Social\Lib\Onboard\Classes\Plugin_Status::instance();
        $plugins = \WP_Social\Lib\Onboard\Attr::instance()->utils->get_option('settings', []);

        $elementskit = $pluginStatus->get_status( 'elementskit-lite/elementskit-lite.php' );
        $getgenie = $pluginStatus->get_status( 'getgenie/getgenie.php' );
        $shopengine = $pluginStatus->get_status( 'shopengine/shopengine.php' );
        $metform = $pluginStatus->get_status( 'metform/metform.php' );
        $emailkit = $pluginStatus->get_status( 'emailkit/EmailKit.php' );
        $popupkit = $pluginStatus->get_status( 'popup-builder-block/popup-builder-block.php' );
        $review = $pluginStatus->get_status( 'wp-ultimate-review/wp-ultimate-review.php' );
        $social = $pluginStatus->get_status( 'wp-social/wp-social.php' );

        $gutenkit = $pluginStatus->get_status( 'gutenkit-blocks-addon/gutenkit-blocks-addon.php' );
        $tablekit = $pluginStatus->get_status( 'table-builder-block/table-builder-block.php' );

        $woocommerce = $pluginStatus->get_status( 'woocommerce/woocommerce.php' );
        // Show unchecked when WooCommerce is active but ShopEngine is deactivated
        $shopengine_pre_check = '';
        ?>
        <!-- 1. AI Content & SEO Tool (GetGenie) - First position -->
        <div class="attr-col-lg-3">
            <div class="wslu-onboard-single-plugin <?php echo $getgenie['status'] == 'activated' ? 'activated' : ''; ?>">
                <label>
                    <div class="wslu-onboard-single-plugin--header">
                        <h3>AI Content & SEO Tool</h3>
                    </div>
                    <?php if($getgenie['status'] !== 'activated') : ?>
                        <div class="wslu-onboard-single-plugin--checkbox-wrapper">
                            <input type="checkbox" class="wslu-onboard-single-plugin--input" value="getgenie/getgenie.php" name="our_plugins[]">
                        </div>
                    <?php endif; ?>
                    <p class="wslu-onboard-single-plugin--description">
                        <?php echo esc_html__('Find top keywords, create winning content & track SEO results with AI.', 'wp-social' ); ?>
                    </p>
                </label>
            </div>
        </div>
        <!-- 2. Page Builder Elements (ElementsKit) - Second position -->
        <div class="attr-col-lg-3">
            <div class="wslu-onboard-single-plugin <?php echo $elementskit['status'] == 'activated' ? 'activated' : ''; ?>">
                <label>
                    <div class="wslu-onboard-single-plugin--header">
                        <h3>Page Builder Elements</h3>
                    </div>
                    <?php if($elementskit['status'] !== 'activated') : ?>
                        <div class="wslu-onboard-single-plugin--checkbox-wrapper">
                            <input type="checkbox" class="wslu-onboard-single-plugin--input" value="elementskit-lite/elementskit-lite.php" name="our_plugins[]">
                        </div>
                    <?php endif; ?>
                    <p class="wslu-onboard-single-plugin--description">
                        <?php echo esc_html__( 'Best companion for Elementor with top widgets and templates.', 'wp-social' ); ?>
                    </p>
                </label>
            </div>
        </div>
        <!-- 3. Form Builder (MetForm) - Third position -->
        <div class="attr-col-lg-3">
            <div class="wslu-onboard-single-plugin <?php echo $metform['status'] == 'activated' ? 'activated' : ''; ?>">
                <label>
                    <div class="wslu-onboard-single-plugin--header">
                        <h3>Form Builder</h3>
                    </div>
                    <?php if($metform['status'] !== 'activated') : ?>
                        <div class="wslu-onboard-single-plugin--checkbox-wrapper">
                            <input type="checkbox" class="wslu-onboard-single-plugin--input" value="metform/metform.php" name="our_plugins[]">
                        </div>
                    <?php endif; ?>
                    <p class="wslu-onboard-single-plugin--description">
                        <?php echo esc_html__( 'Most flexible drag-and-drop form builder for WordPress.', 'wp-social' ); ?>
                    </p>
                </label>
            </div>
        </div>
        <!-- 4. WooCommerce Builder (ShopEngine) - Fourth position -->
        <div class="attr-col-lg-3">
            <div class="wslu-onboard-single-plugin <?php echo $shopengine['status'] == 'activated' ? 'activated' : ''; ?>">
                <label>
                    <div class="wslu-onboard-single-plugin--header">
                        <h3>WooCommerce Builder</h3>
                    </div>
                    <?php if($shopengine['status'] !== 'activated') : ?>
                        <div class="wslu-onboard-single-plugin--checkbox-wrapper">
                            <input type="checkbox" class="wslu-onboard-single-plugin--input" value="shopengine/shopengine.php" name="our_plugins[]" <?php echo esc_attr($shopengine_pre_check); ?>>
                        </div>
                    <?php endif; ?>
                    <p class="wslu-onboard-single-plugin--description">
                        <?php echo esc_html__( 'The ultimate solution to build a complete WooCommerce site in Elementor.', 'wp-social' ); ?>
                    </p>
                </label>
            </div>
        </div>
        <!-- 5. Email Customizer (EmailKit) - Fifth position -->
        <div class="attr-col-lg-3">
            <div class="wslu-onboard-single-plugin <?php echo $emailkit['status'] == 'activated' ? 'activated' : ''; ?>">
                <label>
                    <div class="wslu-onboard-single-plugin--header">
                        <h3>Email Customizer</h3>
                    </div>
                    <?php if($emailkit['status'] !== 'activated') : ?>
                        <div class="wslu-onboard-single-plugin--checkbox-wrapper">
                            <input type="checkbox" class="wslu-onboard-single-plugin--input" value="emailkit/EmailKit.php" name="our_plugins[]">
                        </div>
                    <?php endif; ?>
                    <p class="wslu-onboard-single-plugin--description">
                        <?php echo esc_html__( 'Drag-and-drop email builder for WooCommerce & WordPress.', 'wp-social' ); ?>
                    </p>
                </label>
            </div>
        </div>
        <!-- 6. Popup Builder (PopupKit) - Sixth position -->
        <div class="attr-col-lg-3">
            <div class="wslu-onboard-single-plugin <?php echo $popupkit['status'] == 'activated' ? 'activated' : ''; ?>">
                <label>
                    <div class="wslu-onboard-single-plugin--header">
                        <h3>Popup Builder</h3>
                    </div>
                    <?php if($popupkit['status'] !== 'activated') : ?>
                        <div class="wslu-onboard-single-plugin--checkbox-wrapper">
                            <input type="checkbox" class="wslu-onboard-single-plugin--input" value="popup-builder-block/popup-builder-block.php" name="our_plugins[]">
                        </div>
                    <?php endif; ?>
                    <p class="wslu-onboard-single-plugin--description">
                        <?php echo esc_html__( 'Design popups that convert, right in your WordPress dashboard.', 'wp-social' ); ?>
                    </p>
                </label>
            </div>
        </div>
        <!-- 7. Review Management (WP Ultimate Review) - Seventh position -->
        <div class="attr-col-lg-3">
            <div class="wslu-onboard-single-plugin <?php echo $review['status'] == 'activated' ? 'activated' : ''; ?>">
                <label>
                    <div class="wslu-onboard-single-plugin--header">
                        <h3>Review Management</h3>
                    </div>
                    <?php if($review['status'] !== 'activated') : ?>
                        <div class="wslu-onboard-single-plugin--checkbox-wrapper">
                            <input type="checkbox" class="wslu-onboard-single-plugin--input" value="wp-ultimate-review/wp-ultimate-review.php" name="our_plugins[]">
                        </div>
                    <?php endif; ?>
                    <p class="wslu-onboard-single-plugin--description">
                        <?php echo esc_html__( 'Build credibility for your business with the all-in-one review plugin.', 'wp-social' ); ?>
                    </p>
                </label>
            </div>
        </div>
        <!-- 8. Gutenberg Blocks (GutenKit) - Eighth position -->
        <div class="attr-col-lg-3">
            <div class="wslu-onboard-single-plugin <?php echo $gutenkit['status'] == 'activated' ? 'activated' : ''; ?>">
                <label>
                    <div class="wslu-onboard-single-plugin--header">
                        <h3>Gutenberg Blocks</h3>
                    </div>
                    <?php if($gutenkit['status'] !== 'activated') : ?>
                        <div class="wslu-onboard-single-plugin--checkbox-wrapper">
                            <input type="checkbox" class="wslu-onboard-single-plugin--input" value="gutenkit-blocks-addon/gutenkit-blocks-addon.php" name="our_plugins[]">
                        </div>
                    <?php endif; ?>
                    <p class="wslu-onboard-single-plugin--description">
                        <?php echo esc_html__( 'Enhance block capability with page builder features & templates for Gutenberg.', 'wp-social' ); ?>
                    </p>
                </label>
            </div>
        </div>
    </div>
</div>
<div class="wslu-onboard-pagination">
    <div class="wslu-onboard-left">
        <a class="wslu-onboard-btn wslu-step-3-back-btn wslu-onboard-pagi-btn prev" href="#"><i class="icon xs-onboard-arrow-left"></i><?php echo esc_html__('Back', 'wp-social'); ?></a>
    </div>
    <div class="wslu-onboard-right">
        <a class="wslu-continue-button wslu-onboard-pagi-btn next" href="#"><?php echo esc_html__('Continue', 'wp-social'); ?></a>
        <a class="wslu-onboard-btn wslu-onboard-pagi-btn wslu-onboard-select-all-next-btn next" href="#"><?php echo esc_html__('Unlock All & Continue', 'wp-social'); ?></a>
    </div>
</div>
<div class="wslu-onboard-shapes">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-06.png" alt="" class="shape-06">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-10.png" alt="" class="shape-10">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-11.png" alt="" class="shape-11">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-12.png" alt="" class="shape-12">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-13.png" alt="" class="shape-13">
</div>