<?php
/**
 * Home hero: 3-slide carousel (fade, arrows only, auto-rotate)
 */
$theme_uri = get_template_directory_uri();
?>
<section class="hero_section intro_section page_slider home_hero_slider ds nav-arrow">
	<div class="flexslider" data-nav="true" data-dots="false" data-speed="7000">
		<ul class="slides">

			<!-- Slide 1: Welcome -->
<li class="cover-image hero_slide hero_slide--welcome">
	<img src="<?php echo esc_url( $theme_uri . '/img/catalog-glass-bg.jpg' ); ?>" alt="">
	<img class="hero_watermark" src="<?php echo esc_url( $theme_uri . '/img/logo.png' ); ?>" alt="">
	<div class="container hero_slide__inner">
		<div class="row justify-content-center justify-content-lg-end">
			<div class="col-lg-6 col-xl-5 text-center text-lg-left">
				<div class="hero_content">
					<h1 class="hero_title">Welcome to Serelite</h1>
					<p class="hero_subtitle">Premium Glass, Steel &amp; Architectural Solutions</p>
				</div>
			</div>
		</div>
	</div>
</li>

			<!-- Slide 2: Our Mission -->
			<li class="cover-image hero_slide hero_slide--split">
				<img src="<?php echo esc_url( $theme_uri . '/img/mission-steel-bg.jpg' ); ?>" alt="<?php esc_attr_e( 'Our Mission', 'weldo' ); ?>">
				<span class="hero_overlay hero_overlay--light"></span>
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-left">
							<img class="home_hero_side_image home_hero_logo"
								src="<?php echo esc_url( $theme_uri . '/img/logo160.png' ); ?>"
								alt="<?php esc_attr_e( 'Serelite logo', 'weldo' ); ?>">
						</div>
						<div class="col-lg-6">
							<div class="home_hero_text">
								<h2 class="home_hero_heading">Our Mission</h2>
								<div class="home_hero_paragraph">
									<!-- Paste exact Mission copy from /ueber-uns/ -->
									<p>Replace with your Über Uns “Our Mission” paragraph(s).</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>

			<!-- Slide 3: Our Vision -->
			<li class="cover-image hero_slide hero_slide--split">
				<img src="<?php echo esc_url( $theme_uri . '/img/vision-bg.jpg' ); ?>" alt="<?php esc_attr_e( 'Our Vision', 'weldo' ); ?>">
				<span class="hero_overlay hero_overlay--light"></span>
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-left">
							<img class="home_hero_side_image"
								src="<?php echo esc_url( $theme_uri . '/img/vision-side.jpg' ); ?>"
								alt="<?php esc_attr_e( 'Our Vision', 'weldo' ); ?>">
						</div>
						<div class="col-lg-6">
							<div class="home_hero_text">
								<h2 class="home_hero_heading">Our Vision</h2>
								<div class="home_hero_paragraph">
									<!-- Paste exact Vision copy from /ueber-uns/ -->
									<p>Replace with your Über Uns “Our Vision” paragraph(s).</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>

		</ul>
	</div>
</section>