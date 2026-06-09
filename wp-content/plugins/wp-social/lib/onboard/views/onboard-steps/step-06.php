<div class="wslu-onboard-main-header">
	<h1 class="wslu-onboard-main-header--title"><strong><?php echo esc_html__('Great! You are All Set!', 'wp-social'); ?></strong></h1>
	<div class="wslu-onboard-main-header--description-wrapper">
		<p class="wslu-onboard-main-header--description">
			<?php echo esc_html__('Here is an overview of everything that is setup.', 'wp-social'); ?>
		</p>
		<span class="wslu-onboard-main-header--progress-percentage">0%</span>
	</div>
	<div class="wslu-onboard-main-header--progress-bar">
		<div class="wslu-onboard-main-header--progress"></div>
	</div>
</div>

<div class="configure-features" id="configure-wslu-onboard"></div>

<div class="go-to-dashboard">
	<a class="wslu-onboard-btn" href="<?php echo esc_url(admin_url('admin.php?page=wslu_global_setting')); ?>">
		<?php echo esc_html__( 'Go to WP Dashboard', 'wp-social' ); ?>
	</a>
</div>

<script>
    const target = document.getElementById('configure-wslu-onboard');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Create and dispatch a custom event
                const event = new CustomEvent('configureWsluOnboard', {
                    detail: { message: 'configuring wslu onboard' }
                });

                // Dispatch the event from the element or window
                window.dispatchEvent(event);
            }
        });
    }, {
        threshold: 0.1 // Adjust as needed
    });

    observer.observe(target);
</script>
<div class="wslu-onboard-shapes">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-04.png" alt="" class="shape-04">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-07.png" alt="" class="shape-07">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-15.png" alt="" class="shape-15">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-21.png" alt="" class="shape-21">
    <img src="<?php echo esc_url(self::get_url()); ?>assets/images/onboard/shape-22.png" alt="" class="shape-22">
</div>