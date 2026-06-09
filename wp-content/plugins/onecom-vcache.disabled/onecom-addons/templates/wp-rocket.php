<?php
$oc_wp_rocket            = new OCVCaching();
$wp_rocket_addon_info = $oc_wp_rocket->oc_wp_rocket_addon_info( true );
$oc_vc_uri = $oc_wp_rocket->oc_vc_uri;
if ( ! defined( 'WP_ROCKET_BUTTON_LABEL' ) ) {
	define( 'WP_ROCKET_BUTTON_LABEL', 'Get WP Rocket' );
}

$wp_rocket_icon = $oc_vc_uri . '/assets/images/wp-rocket-icon.svg';
$checklist_icon = $oc_vc_uri . '/assets/images/check-list.svg';
$addon_slug = "wp-rocket";
$transient_key = "{$addon_slug}_activation_start_at";

// Get the start time from transient
$start_time = get_site_transient( $transient_key );
?>
<!-- Main Wrapper "wp-rocket" -->
<div class="wrap2 gv-activated wpr-container" data-activation-state="<?php echo $start_time;?>">
	<div class="inner-wrapper gv-p-fluid gv-pt-0 gv-pb-0">
		<!-- Notice area -->
		<?php
		if(!$oc_wp_rocket->is_wp_rocket_active() && $oc_wp_rocket->is_wp_rocket_addon_purchased() && !$start_time){
            $oc_wp_rocket->get_wpr_activate_info();
		}

        $oc_wp_rocket->get_wpr_in_progress_notice();
        $oc_wp_rocket->get_wpr_error_notice();
        $oc_wp_rocket->get_wpr_success_notice();
		?>
		<!-- Notice area End -->
		<article class="gv-layout-product gv-product-single gv-w-max-container gv-mx-auto gv-pl-lg2 gv-pr-fluid2">
			<!-- header section -->
			<header class="gv-product-header gv-area-header wpr-section-header">
				<div class="gv-content gv-stack-space-md gv-text-sm">
					<h3><?php echo __('Speed up your site', 'vcaching'); ?></h3>
					<p class="gv-text-sm"><?php echo __('Improve your website performance with the best WordPress caching plugin out there.  Get it here and save 40% of the regular price.', 'vcaching'); ?></p>
				</div>
				<div class="gv-image gv-p-fluid gv-text-center wpr-img-container">
					<img src="<?php echo $oc_vc_uri . "/assets/images/wp-rocket-v2.svg";?>" alt="<?php echo __('WP Rocket', 'vcaching'); ?>" class="gv-p-lg gv-max-mob-p-0 gv-max-tab-p-0" />
					<img src="<?php echo $oc_vc_uri . "/assets/images/wpr-tablet.svg";?>" alt="<?php echo __('WP Rocket', 'vcaching'); ?>" class="gv-p-lg gv-max-mob-p-0 gv-max-tab-p-0" />
				</div>
			</header>
			<!-- header section end -->
			<!-- Pricing section -->
			<?php $oc_wp_rocket->wp_rocket_pricing_table();?>
			<!-- Pricing section End -->
			<!-- desc section -->
			<div class="gv-area-details gv-grid gv-gap-lg">
				<section class="gv-stack-space-md">
					<h2 class="gv-title gv-text-bold gv-text-lg"><?php echo __('Key benefits', 'vcaching'); ?></h2>
					<ul class="gv-list-items2 gv-list-check gv-mode-condensed key-benefits">
						<li class="gv-text-sm gv-mb-md"><?php echo __('WP Rocket is one.com’s trusted partner and works seamlessly with our plugins and services.', 'vcaching'); ?></li>
						<li class="gv-text-sm gv-mb-md"><?php echo __('Instantly improve your website’s loading speed and Core Web Vitals scores.', 'vcaching'); ?></li>
						<li class="gv-text-sm"><?php echo __('Immediately apply 80% of best practices for web performance by completing the easy setup.', 'vcaching'); ?></li>
					</ul>
				</section>
				<section class="gv-text-max gv-text-sm gv-stack-space-md">
					<h2 class="gv-title gv-text-bold gv-text-lg"><?php echo __('Make your WordPress website faster - quickly and easily', 'vcaching'); ?></h2>
					<p class="gv-text-sm gv-mb-lg">
						<?php echo __('Today’s visitors expect your website to load instantly so speed is no longer optional. Even shaving off a few milliseconds can boost your conversion rates and lift your search engine rankings.', 'vcaching'); ?>
					</p>
					<p class="gv-text-sm">
						<?php echo __('That’s where WP Rocket comes in. It empowers anyone to supercharge their website’s performance and SEO. Whether you\'re a blogger eager for a lightning-fast blog, a freelancer or agency building high-performing sites for clients, or an e-commerce brand focused on delivering a seamless shopping experience, WP Rocket gives you the tools to make it happen. Fast, easy, effective and no coding required.', 'vcaching'); ?>
					</p>
				</section>
			</div>
			<!-- desc section End -->
		</article>
	</div>
</div>
<div class="clear"> </div>