(function ($) {
	$(document).ready(function () {
		$('#oc-restart-tour').click(function () {
			console.info('Restart tour')
		})


		$("#oc-start-tour, #oc_login_masking_overlay_wrap .oc_welcome_modal_close").on('click', function (e) {
			e.preventDefault();
			$("#oc_login_masking_overlay").hide();
			$(".loading-overlay.fullscreen-loader").removeClass('show');
			let redirect = true;
			console.log($(this));
			if($(this).hasClass('oc_welcome_modal_close')){
				redirect = false;
			}
			const nonce = 'asdsadsad';

			$.post(oc_home_ajax_obj.ajax_url, {
				'action': 'oc_close_welcome_modal',
				'nonce': nonce
			})
				.done(function (response) {
					if (response && redirect) {
						window.location.href = oc_home_ajax_obj.home_url;
					}else{
						console.log('modal closed');
					}
				})
				.fail(function () {
					console.error("Failed to close the welcome modal.");
				});
		});

		// Show data consent modal
		$(".oc_consent_modal_show").on('click', function (e) {
			e.preventDefault();
			$("#oc_data_consent_overlay").show();
		});

		// Hide data consent modal
		$("#oc-consent-modal-close, #oc_data_consent_overlay .oc_welcome_modal_close").on('click', function (e) {
			e.preventDefault();
			$("#oc_data_consent_overlay").hide();
			$(".loading-overlay.fullscreen-loader").removeClass('show');
		});

		// Calculate top padding for pages having floating consent banner
		window.addEventListener('load', function() {
			const banner = document.getElementById('oc-data-consent-banner');

			if (!banner) return;

			// Fallback: if PHP hook missed adding body class, add it via JS
			if (!document.body.classList.contains('oc-consent-banner-active')) {
				document.body.classList.add('oc-consent-banner-active');
			}

			updateBannerHeight();

			let resizeTimer;
			window.addEventListener('resize', function() {
				clearTimeout(resizeTimer);
				resizeTimer = setTimeout(updateBannerHeight, 300);
			});

			function updateBannerHeight() {
				// No top spacing needed on mobile (banner is fixed bottom there)
				if (window.innerWidth <= 599) {
					document.documentElement.style.setProperty('--consent-banner-height', '0px');
					return;
				}

				const height = banner.offsetHeight;

				// Safety check — if height is 0, banner not rendered yet, try again
				if (height === 0) {
					requestAnimationFrame(updateBannerHeight);
					return;
				}

				document.documentElement.style.setProperty('--consent-banner-height', height + 'px');
			}
		});

		// Update data consent status based on actions
		function ocShowConsentToast(containerId, type, message) {
			// Hide any already visible toast on the page
			$('.gv-toast-container .gv-toast.gv-visible').removeClass('gv-visible').addClass('gv-invisible');

			var toastClass = type === 'success' ? 'gv-toast-success' : 'gv-toast-alert';
			var closeIcon = oc_home_ajax_obj.close_icon || '';
			var html = '<div class="gv-toast ' + toastClass + ' gv-visible">' +
				'<div class="gv-toast-content"><div>' + message + '</div></div>' +
				'<button class="gv-toast-close"><gv-icon src="' + closeIcon + '"></gv-icon></button>' +
				'</div>';

			var $container = $(containerId);
			$container.html(html);
			$('.oc-consent-toast-container').show();

			$container.find('.gv-toast-close').on('click', function () {
				$container.find('.gv-toast').removeClass('gv-visible');
			});

			setTimeout(function () {
				$container.find('.gv-toast').removeClass('gv-visible');
			}, 5000);
		}

		var consentUpdateInProgress = false;
		function ocUpdateConsentStatus(status) {
			if (consentUpdateInProgress) return;
			consentUpdateInProgress = true;

			const data = {
				action: 'oc_update_consent_status',
				consent_status: status
			};

			fetch(oc_home_ajax_obj.ajax_url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams(data),
			})
				.then(response => response.json())
				.then(result => {
					if (result.success) {
						$('body').removeClass('oc-consent-banner-active');
						ocShowConsentToast('#oc-consent-toast-success', 'success', oc_home_ajax_obj.toast_success_msg);

						$("#oc-data-consent-banner").hide();
						if (status === 1) {
							$('#oc-data-consent-toggle').prop('checked', true);
						}

						// Store consent status in localStorage for cross-page communication
						localStorage.setItem('onecom_data_consent_status', result.data.consent_status);

						//Dispatch custom event for other scripts to listen to (same page)
						//Dispatching to marketplace service to track consent status change
						const event = new CustomEvent('onConsentStatusChanged', { detail: { data_consent_status: result.data.consent_status } });
						window.dispatchEvent(event);
					} else {
						$('body').removeClass('oc-consent-banner-active');
						ocShowConsentToast('#oc-consent-toast-failure', 'alert', oc_home_ajax_obj.toast_failure_msg);
					}
				})
				.catch(error => {
					ocShowConsentToast('#oc-consent-toast-failure', 'alert', oc_home_ajax_obj.toast_failure_msg);
				})
				.finally(function () {
					consentUpdateInProgress = false;
				});
		}
		$("#oc-consent-settings input[type='checkbox']").on('click', function () {
			const status = $(this).is(':checked') ? 1 : 0;
			ocUpdateConsentStatus(status);
		});
		$('.oc-data-consent-decline').on('click', function () {
			ocUpdateConsentStatus(0);
		});
		$('.oc-data-consent-accept').on('click', function () {
			ocUpdateConsentStatus(1);
		});
		$('.oc-data-consent-dismiss').on('click', function () {
			ocUpdateConsentStatus('dismissed');
		});

		// Show premium WP care form
		$(".oc_premium_care_modal_show").on('click', function (e) {
			e.preventDefault();
			$("#oc_premium_care_overlay").show();
		});

		// Open premium WP care modal with direct URL, and remove hash to load modal once
		const urlParams = new URLSearchParams(window.location.search);
		if (urlParams.get('page') === "onecom-home" && urlParams.get('request-premium-wp-care') === "1") {
			$("#oc_premium_care_overlay").show();
			history.replaceState(null, null, window.location.pathname + "?page=onecom-home");
		}

		// Hide premium WP care modal
		$("#oc-premium-care-modal-close, #oc_premium_care_overlay .oc_welcome_modal_close").on('click', function (e) {
			e.preventDefault();
			$("#oc_premium_care_overlay").hide();
			$(".loading-overlay.fullscreen-loader").removeClass('show');
			$("#premium-care-request-error").hide();
		});

		$(".oc-premium-care-box .gv-notice-close").on('click', function (e) {
			$.post(oc_home_ajax_obj.ajax_url, {
					_ajax_nonce: oc_home_ajax_obj.nonce,
					action: "oc_home_premium_care_dismiss"
				}, function (data) {
					if (data.status === 'success') {
						$(".oc-premium-care-box").hide();
					} else {
						console.error( 'Error: Failed to dismiss premium wp care tile.' );
					}
				}
			);
		});

		$("#oc-premium-care-request-notice .gv-notice-close").on('click', function (e) {
			$("#oc-premium-care-request-notice").hide();
		});

		$('#oc-premium-care-request-action').on('click', function () {
			ocRequestPremiumCareRequest();
		});

		// Request premium wp care
		function ocRequestPremiumCareRequest() {
			let text = $("#oc-premium-care-description").val();
			const data = {
				action: 'oc_request_premium_care',
				premium_wp_request: 1,
				text: text
			};
			$('#modal-loader-overlay').css('display', 'flex');

			fetch(oc_home_ajax_obj.ajax_url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams(data),
			})
				.then(response => response.json())
				.then(result => {
					$('#modal-loader-overlay').hide();
					if (result.success) {
						$(".gv-notice-premium-care").hide();
						$(".gv-notice-premium-care-requested").removeClass('gv-hidden');
						$("#oc-premium-care-request-notice").removeClass('gv-hidden');
						$("#oc_premium_care_overlay").hide();
						$(".loading-overlay.fullscreen-loader").removeClass('show');
						$('html, body').animate({
							scrollTop: $('.inner-wrapper').offset().top
						}, 500);
					} else {
						$('#modal-loader-overlay').hide();
						$("#premium-care-request-error").css('display', 'flex');
					}
				})
				.catch(error => {
					$('#modal-loader-overlay').hide();
					$("#premium-care-request-error").css('display', 'flex');
				});
		}

	});
})(jQuery)