<?php
/**
 * Home hero: 3-slide carousel (fade, arrows only, auto-rotate)
 */
// $theme_uri = get_template_directory_uri();
$theme_uri = get_template_directory_uri();
$slide1_bg_left  = $theme_uri . '/img/catalog-glass-bg.jpeg';
$slide1_bg_right = $theme_uri . '/img/reference_image.jpeg';
$uploads = content_url( '/uploads' );
$slide2_image = $uploads . '/2026/06/slide_2.jpeg'; 
$slide3_image = $uploads . '/2026/06/slide_4.jpeg';
 // same image, darkened with CSS

// Mission slide images — use FULL URL only (no $uploads_base prefix)
$mission_img_front = content_url( '/uploads/2026/06/logo_2.png' );
$mission_img_back  = content_url( '/uploads/2026/06/logo_2.png' ); 
// Vision slide images
$vision_img_front = content_url( '/uploads/2026/06/logo_3.png' );  // change to your vision image
$vision_img_back  = content_url( '/uploads/2026/06/logo_3.png' );  // second image for overlap, optional // same image, or a second one if you add it
?>
<section class="hero_section intro_section page_slider home_hero_slider ds nav-arrow">
	<div class="flexslider" data-nav="true" data-dots="false" data-speed="7000">
		<ul class="slides">

			<!-- Slide 1: Welcome -->
<!-- Slide 1: Welcome — dual images, text centered -->
<li class="hero_slide hero_slide--welcome hero_slide--dual ds">
	<div class="hero_slide__dual-bg">
		<div class="hero_slide__dual-left">
			<img src="<?php echo esc_url( $slide1_bg_left ); ?>" alt="">
		</div>
		<div class="hero_slide__dual-right">
			<img src="<?php echo esc_url( $slide1_bg_right ); ?>" alt="">
		</div>
	</div>
	<span class="hero_slide__dual-overlay"></span>
<div class="hero_content hero_content--center">
	<h1 class="hero_title">Willkommen bei Serelite</h1>
	<span class="hero_golden-line" aria-hidden="true"></span>
	<p class="hero_subtitle">Seit seiner Gründung im Jahr 2020 hat sich SERELIT zu einem der angesehensten Hersteller von Bau-, sonstigem und dekorativem Stahl für den Mehrfamilien-, Gewerbe- und Wohnungsbau in Istanbul entwickelt.</p>
</div>
</li>

			<!-- Slide 2: Our Mission -->
		<!-- Slide 2: Unsere Mission (from Über Uns) -->
			<!-- Slide 2: Unsere Mission -->
			<li class="hero_slide hero_slide--split hero_slide--mission ds">
				<div class="hero_mission-media">
					<img src="<?php echo esc_url( $slide2_image ); ?>" alt="<?php esc_attr_e( 'Unsere Mission', 'weldo' ); ?>">
				</div>
				<div class="container">
					<div class="row align-items-center h-100">
						<div class="col-lg-8 d-none d-lg-block"></div>
						<div class="col-lg-4">
							<div class="home_hero_text">
								<h3 class="big special-heading">
									<span class="color-main">Unsere</span> Mission
								</h3>
								<!-- <p class="special-heading subheading with-line"> -->
								<span class="hero_golden-line" aria-hidden="true"></span>
								<!-- </p> -->
								<div class="home_hero_paragraph">
									<p>Ein Aluminiumunternehmen zu sein, das die Bedürfnisse und Erwartungen der Kunden versteht, indem es globalen technologischen und industriellen Trends folgt. Die Kundenzufriedenheit steht bei allen von uns angebotenen Dienstleistungen an erster Stelle. Um alle Bedürfnisse und Erwartungen unserer Kunden zu erfüllen, versuchen wir, ihre Wünsche vollständig und vollständig zu verstehen, und als SERELiT Aluminium sind wir bestrebt, jederzeit und für jeden Kunden Qualität und Service zu bieten, die die Erwartungen übertreffen.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>

			<!-- Slide 3: Our Vision -->
			<!-- Slide 3: Unsere Vision -->
			<!-- Slide 3: Unsere Vision -->
			<li class="hero_slide hero_slide--split hero_slide--vision ds">
				<div class="hero_vision-media">
					<img src="<?php echo esc_url( $slide3_image ); ?>" alt="<?php esc_attr_e( 'Unsere Vision', 'weldo' ); ?>">
				</div>
				<div class="container">
					<div class="row align-items-center h-100">
					<div class="col-lg-4 offset-lg-1">
							<div class="home_hero_text">
								<h3 class="big special-heading">
									<span class="color-main">Unsere</span> Vision
								</h3>
								<span class="hero_golden-line" aria-hidden="true"></span>
								<div class="home_hero_paragraph">
									<p>Ein Aluminiumunternehmen zu sein, das ein Symbol für Vertrauen und Qualität ist.
									Die Erwartungen unserer Stakeholder auf höchstem Niveau zu erfüllen, indem wir den Sektor mit seinen innovativen Lösungen, menschenorientierten und umweltfreundlichen Ansätzen anführen.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-7 d-none d-lg-block"></div>
					</div>
				</div>
			</li>

		</ul>
	</div>
</section>