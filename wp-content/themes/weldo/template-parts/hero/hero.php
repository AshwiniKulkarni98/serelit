<?php
/**
 * Home hero: 3-slide carousel (fade, arrows only, auto-rotate)
 */
// $theme_uri = get_template_directory_uri();
$theme_uri = get_template_directory_uri();
$slide1_bg = $theme_uri . '/img/catalog-glass-bg.jpeg';

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
<!-- Slide 1: Welcome (split layout) -->
<li class="hero_slide hero_slide--welcome ds">
	<div class="row no-gutters align-items-stretch hero_slide__split">
		<!-- Left: big glass image -->
		<div class="col-lg-5 hero_slide__image-col">
			<img src="<?php echo esc_url( $slide1_bg ); ?>" alt="<?php esc_attr_e( 'Welcome', 'weldo' ); ?>">
		</div>
		<!-- Right: dark textured panel + text -->
		<div class="col-lg-7 hero_slide__content-col texture-background">
			<div class="hero_content">
				<h1 class="hero_title">Welcome to Serelite</h1>
				<p class="hero_subtitle">Seit seiner Gründung im Jahr 2020 hat sich SERELIT zu einem der angesehensten Hersteller von Bau-, sonstigem und dekorativem Stahl für den Mehrfamilien-, Gewerbe- und Wohnungsbau in Istanbul entwickelt.</p>
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
			<!-- Slide 3: Unsere Vision -->
<li class="hero_slide hero_slide--split hero_slide--vision ds">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-left">
				<div class="images-wrap-item img-left">
					<img src="<?php echo esc_url( $vision_img_front ); ?>" alt="<?php esc_attr_e( 'Unsere Vision', 'weldo' ); ?>">
					<img class="image-back" src="<?php echo esc_url( $vision_img_back ); ?>" alt="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="home_hero_text">
					<h3 class="big special-heading">
						<span class="color-main">Unsere</span> Vision
					</h3>
					<p class="special-heading subheading with-line">
						<span class="big-letter-spacing">ZUKUNFT!</span>
					</p>
					<div class="home_hero_paragraph">
						<p>Ein Aluminiumunternehmen zu sein, das ein Symbol für Vertrauen und Qualität ist.
						Die Erwartungen unserer Stakeholder auf höchstem Niveau zu erfüllen, indem wir den Sektor mit seinen innovativen Lösungen, menschenorientierten und umweltfreundlichen Ansätzen anführen.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</li>

		</ul>
	</div>
</section>