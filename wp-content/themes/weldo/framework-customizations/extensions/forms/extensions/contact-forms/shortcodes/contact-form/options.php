<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'type'    => 'box',
		'title'   => '',
		'options' => array(
			'id'       => array(
				'type' => 'unique',
			),
			'builder'  => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Form Fields', 'weldo' ),
				'options' => array(
					'form' => array(
						'label'        => false,
						'type'         => 'form-builder',
						'value'        => array(
							'json' => apply_filters( 'fw:ext:forms:builder:load-item:form-header-title', true )
								? json_encode( array(
									array(
										'type'      => 'form-header-title',
										'shortcode' => 'form_header_title',
										'width'     => '',
										'options'   => array(
											'title'    => '',
											'subtitle' => '',
										)
									)
								) )
								: '[]'
						),
						'fixed_header' => true,
					),
				),
			),
			'settings' => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Settings', 'weldo' ),
				'options' => array(
					'settings-options' => array(
						'title'   => esc_html__( 'Contact Form Options', 'weldo' ),
						'type'    => 'tab',
						'options' => array(
							'background_color'      => array(
								'type'    => 'select',
								'value'   => 'ls',
								'label'   => esc_html__( 'Form Background color', 'weldo' ),
								'desc'    => esc_html__( 'Select background color', 'weldo' ),
								'help'    => esc_html__( 'Select one of predefined background colors', 'weldo' ),
								'choices' => array(
									''              => esc_html__( 'No background', 'weldo' ),
									'p-40 muted-bg' => esc_html__( 'Muted', 'weldo' ),
									'p-40 bordered' => esc_html__( 'With Border', 'weldo' ),
									'p-40 ls'       => esc_html__( 'Light', 'weldo' ),
									'p-40 ls ms'    => esc_html__( 'Light Grey', 'weldo' ),
									'p-40 ds'       => esc_html__( 'Dark Grey', 'weldo' ),
									'p-40 ds ms'    => esc_html__( 'Dark', 'weldo' ),
									'p-40 cs'       => esc_html__( 'Main color', 'weldo' ),
									'p-40 cs cs2'   => esc_html__( 'Second Main color', 'weldo' ),
								),
							),
							'small_form'            => array(
								'type'         => 'switch',
								'value'        => '',
								'label'        => esc_html__( 'Small Form', 'weldo' ),
								'desc'         => esc_html__( 'Select between small form and default form', 'weldo' ),
								'left-choice'  => array(
									'value' => '',
									'label' => esc_html__( ' No', 'weldo' ),
								),
								'right-choice' => array(
									'value' => 'small-form',
									'label' => esc_html__( ' Yes', 'weldo' ),
								),
							),
							'columns_padding'       => array(
								'type'    => 'select',
								'value'   => 'c-gutter-30',
								'label'   => esc_html__( 'Columns gutter', 'weldo' ),
								'desc'    => esc_html__( 'Choose columns horizontal padding (gutter) value inside form', 'weldo' ),
								'choices' => array(
									'c-gutter-30' => esc_html__( '30px - default', 'weldo' ),
									'c-gutter-10' => esc_html__( '10px', 'weldo' ),
									'c-gutter-15' => esc_html__( '15px', 'weldo' ),
									'c-gutter-20' => esc_html__( '20px', 'weldo' ),
									'c-gutter-40' => esc_html__( '40px', 'weldo' ),
									'c-gutter-50' => esc_html__( '50px', 'weldo' ),
									'c-gutter-60' => esc_html__( '60px', 'weldo' ),
								),
							),
							'columns_margin_bottom' => array(
								'type'    => 'select',
								'value'   => 'c-mb-15',
								'label'   => esc_html__( 'Columns bottom margins', 'weldo' ),
								'desc'    => esc_html__( 'Choose columns bottom margin value inside form', 'weldo' ),
								'choices' => array(
									'c-mb-15' => esc_html__( '15px - default', 'weldo' ),
									'c-mb-5'  => esc_html__( '5px', 'weldo' ),
									'c-mb-10' => esc_html__( '10px', 'weldo' ),
									'c-mb-20' => esc_html__( '20px', 'weldo' ),
									'c-mb-25' => esc_html__( '25px', 'weldo' ),
									'c-mb-30' => esc_html__( '30px', 'weldo' ),
								),
							),
							'form_email_settings'   => array(
								'type'    => 'group',
								'options' => array(
									'email_to' => array(
										'type'  => 'text',
										'label' => esc_html__( 'Email To', 'weldo' ),
										'help'  => esc_html__( 'We recommend you to use an email that you verify often', 'weldo' ),
										'desc'  => esc_html__( 'The form will be sent to this email address.', 'weldo' ),
									),
								),
							),
							'form_text_settings'    => array(
								'type'    => 'group',
								'options' => array(
									'subject-group'       => array(
										'type'    => 'group',
										'options' => array(
											'subject_message' => array(
												'type'  => 'text',
												'label' => esc_html__( 'Subject Message', 'weldo' ),
												'desc'  => esc_html__( 'This text will be used as subject message for the email', 'weldo' ),
												'value' => esc_html__( 'Contact Form', 'weldo' ),
											),
										)
									),
									'submit-button-group' => array(
										'type'    => 'group',
										'options' => array(
											'submit_button_text'       => array(
												'type'  => 'text',
												'label' => esc_html__( 'Submit Button', 'weldo' ),
												'desc'  => esc_html__( 'This text will appear in submit button', 'weldo' ),
												'value' => esc_html__( 'Send', 'weldo' ),
											),
											'submit_button_color'      => array(
												'label'   => esc_html__( 'Submit Button Color', 'weldo' ),
												'desc'    => esc_html__( 'Choose a type for your button', 'weldo' ),
												'value'   => 'btn btn-maincolor',
												'type'    => 'select',
												'choices' => array(
													'btn btn-maincolor'          => esc_html__( 'Color Main', 'weldo' ),
													'btn btn-maincolor2'         => esc_html__( 'Color Main 2', 'weldo' ),
													'btn btn-grey'               => esc_html__( 'Color Grey', 'weldo' ),
													'btn btn-dark'               => esc_html__( 'Color Dark', 'weldo' ),
													'btn btn-outline-maincolor'  => esc_html__( 'Outline Color Main', 'weldo' ),
													'btn btn-outline-maincolor2' => esc_html__( 'Outline Color Main 2', 'weldo' ),
													'btn btn-outline-grey'       => esc_html__( 'Outline Grey', 'weldo' ),
													'btn btn-outline-dark'       => esc_html__( 'Outline Dark', 'weldo' ),
													'btn-link'                   => esc_html__( 'Just link', 'weldo' ),
												
												)
											),
											'submit_button_size'       => array(
												'label'   => esc_html__( 'Submit Button Size', 'weldo' ),
												'desc'    => esc_html__( 'Choose a size for your button', 'weldo' ),
												'value'   => 'btn-small',
												'type'    => 'select',
												'choices' => array(
													'btn-small'  => esc_html__( 'Small', 'weldo' ),
													'btn-medium' => esc_html__( 'Medium', 'weldo' ),
													'btn-big'    => esc_html__( 'Big', 'weldo' ),
												)
											),
											'submit_button_wide'       => array(
												'type'         => 'switch',
												'label'        => esc_html__( 'Submit Wide button', 'weldo' ),
												'desc'         => esc_html__( 'Switch to create wider button', 'weldo' ),
												'left-choice'  => array(
													'value' => '',
													'label' => esc_html__( 'No', 'weldo' ),
												),
												'right-choice' => array(
													'value' => 'btn-wide',
													'label' => esc_html__( 'Yes', 'weldo' ),
												),
											),
											'submit_button_top_margin' => array(
												'type'    => 'select',
												'label'   => esc_html__( 'Submit Button Vertical Margins', 'weldo' ),
												'desc'    => esc_html__( 'Choose button vertical margins value', 'weldo' ),
												'value'   => 'mt-lg-45',
												'choices' => array(
													''         => esc_html__( 'Top and bottom: 0 - default ', 'weldo' ),
													'mt-lg-5'  => esc_html__( '5px', 'weldo' ),
													'mt-lg-10' => esc_html__( '10px', 'weldo' ),
													'mt-lg-15' => esc_html__( '15px', 'weldo' ),
													'mt-lg-20' => esc_html__( '20px', 'weldo' ),
													'mt-lg-30' => esc_html__( '30px', 'weldo' ),
													'mt-lg-40' => esc_html__( '40px', 'weldo' ),
													'mt-lg-45' => esc_html__( '45px', 'weldo' ),
													'mt-lg-50' => esc_html__( '50px', 'weldo' ),
												),
											),
											'reset_button_text'        => array(
												'type'  => 'text',
												'label' => esc_html__( 'Reset Button', 'weldo' ),
												'desc'  => esc_html__( 'This text will appear in reset button. Leave blank if reset button not needed', 'weldo' ),
												'value' => esc_html__( 'Clear', 'weldo' ),
											),
										)
									),
									
									'success-group'   => array(
										'type'    => 'group',
										'options' => array(
											'success_message' => array(
												'type'  => 'text',
												'label' => esc_html__( 'Success Message', 'weldo' ),
												'desc'  => esc_html__( 'This text will be displayed when the form will successfully send', 'weldo' ),
												'value' => esc_html__( 'Message sent!', 'weldo' ),
											),
										)
									),
									'failure_message' => array(
										'type'  => 'text',
										'label' => esc_html__( 'Failure Message', 'weldo' ),
										'desc'  => esc_html__( 'This text will be displayed when the form will fail to be sent', 'weldo' ),
										'value' => esc_html__( 'Oops something went wrong.', 'weldo' ),
									),
								),
							),
						)
					),
					'mailer-options'   => array(
						'title'   => esc_html__( 'Mailer Options', 'weldo' ),
						'type'    => 'tab',
						'options' => array(
							'mailer' => array(
								'label' => false,
								'type'  => 'mailer'
							)
						)
					),
					'additional_class' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Additional CSS class', 'weldo' ),
						'desc'  => esc_html__( 'Add your custom CSS class. Useful for Customization', 'weldo' ),
					),
				),
			),
		),
	)
);