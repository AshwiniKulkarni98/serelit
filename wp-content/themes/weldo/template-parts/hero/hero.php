<?php
/**
 * Home hero: 3-slide carousel (fade, arrows only, auto-rotate)
 */
// $theme_uri = get_template_directory_uri();
$theme_uri = get_template_directory_uri();
$slide1_bg = $theme_uri . '/img/catalog-glass-bg.jpeg';

// Mission slide images — use FULL URL only (no $uploads_base prefix)
$mission_img_front = content_url( '/uploads/2026/06/logo_2.png' );
$mission_img_back  = content_url( '/uploads/2026/06/logo_2.png' );  // same image, or a second one if you add it
?>
<section class="hero_section intro_section page_slider home_hero_slider ds nav-arrow">
	<div class="flexslider" data-nav="true" data-dots="false" data-speed="7000">
		<ul class="slides">

			<!-- Slide 1: Welcome -->
<li class="cover-image hero_slide hero_slide--welcome">
<img src="<?php echo esc_url( $slide1_bg ); ?>" alt="">

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
		<!-- Slide 2: Unsere Mission (from Über Uns) -->
<li class="hero_slide hero_slide--split hero_slide--mission ds">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-left">
				<div class="images-wrap-item img-left">
					<img src="<?php echo esc_url( $mission_img_front ); ?>" alt="<?php esc_attr_e( 'Unsere Mission', 'weldo' ); ?>">
					<img class="image-back" src="<?php echo esc_url( $mission_img_back ); ?>" alt="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="home_hero_text">
					<h3 class="big special-heading">
						<span class="color-main">Unsere</span> Mission
					</h3>
					<p class="special-heading subheading with-line">
						<span class="big-letter-spacing">WILLKOMMEN!</span>
					</p>
					<div class="home_hero_paragraph">
						<p>Ein Aluminiumunternehmen zu sein, das die Bedürfnisse und Erwartungen der Kunden versteht, indem es globalen technologischen und industriellen Trends folgt. Die Kundenzufriedenheit steht bei allen von uns angebotenen Dienstleistungen an erster Stelle. Um alle Bedürfnisse und Erwartungen unserer Kunden zu erfüllen, versuchen wir, ihre Wünsche vollständig und vollständig zu verstehen, und als SERELiT Aluminium sind wir bestrebt, jederzeit und für jeden Kunden Qualität und Service zu bieten, die die Erwartungen übertreffen.</p>
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