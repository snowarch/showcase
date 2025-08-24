<?php
/**
 * Adds options to the customizer.
 */
defined( 'ABSPATH' ) || exit;

/**
 * TetsuoEdgeClassCustomizer class.
 */
class TetsuoEdgeClassCustomizer {
	
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'add_sections' ) );
	}
	
	/**
	 * Get item name.
	 */
	public function get_item_name( $item ) {
		return ucwords( str_replace( '-', ' ', basename( $item ) ) );
	}
	
	/**
	 * Get item class name.
	 */
	public function get_item_class( $item ) {
		return str_replace( '-', '_', basename( $item ) );
	}
	
	/**
	 * Sanitize callback function for checkbox
	 */
	public function sanitize_checkbox( $checked ) {
		return isset( $checked ) && $checked === true;
	}
	
	/**
	 * Add settings to the customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_sections( $wp_customize ) {
		
		$wp_customize->add_panel(
			'tetsuo_performance',
			array(
				'priority' => 250,
				'title'    => esc_html__( 'Tetsuo Performance', 'tetsuo' )
			)
		);
		
		$wp_customize->add_section(
			'tetsuo_performance_icon_packs_section',
			array(
				'panel'       => 'tetsuo_performance',
				'priority'    => 10,
				'title'       => esc_html__( 'Icon Packs', 'tetsuo' ),
				'description' => esc_html__( 'Here you can select specific features to disable. Note that disabling certain features and functionalities which you will not be needing or which you are otherwise not utilizing in any way can have a positive effect to the overall performance of your site.', 'tetsuo' )
			)
		);
		
		foreach ( glob( EDGE_FRAMEWORK_ICONS_ROOT_DIR . '/*', GLOB_ONLYDIR ) as $item ) {
			$wp_customize->add_setting(
				'tetsuo_performance_disable_icon_pack_' . $this->get_item_class( $item ),
				array(
					'default'           => false,
					'type'              => 'option',
					'sanitize_callback' => array( $this, 'sanitize_checkbox' )
				)
			);
			
			$wp_customize->add_control(
				'tetsuo_performance_disable_icon_pack_' . $this->get_item_class( $item ),
				array(
					'section'  => 'tetsuo_performance_icon_packs_section',
					'settings' => 'tetsuo_performance_disable_icon_pack_' . $this->get_item_class( $item ),
					'type'     => 'checkbox',
					'label'    => $this->get_item_name( $item ),
				)
			);
		}
		
		if ( tetsuo_edge_core_plugin_installed() ) {
			$wp_customize->add_section(
				'tetsuo_performance_cpt_section',
				array(
					'panel'       => 'tetsuo_performance',
					'priority'    => 20,
					'title'       => esc_html__( 'Custom Post Types', 'tetsuo' ),
					'description' => esc_html__( 'Here you can select specific features to disable. Note that disabling certain features and functionalities which you will not be needing or which you are otherwise not utilizing in any way can have a positive effect to the overall performance of your site.', 'tetsuo' )
				)
			);
			
			foreach ( glob( TETSUO_CORE_CPT_PATH . '/*', GLOB_ONLYDIR ) as $item ) {
				$wp_customize->add_setting(
					'tetsuo_performance_disable_cpt_' . $this->get_item_class( $item ),
					array(
						'default'           => false,
						'type'              => 'option',
						'sanitize_callback' => array( $this, 'sanitize_checkbox' )
					)
				);
				
				$wp_customize->add_control(
					'tetsuo_performance_disable_cpt_' . $this->get_item_class( $item ),
					array(
						'section'  => 'tetsuo_performance_cpt_section',
						'settings' => 'tetsuo_performance_disable_cpt_' . $this->get_item_class( $item ),
						'type'     => 'checkbox',
						'label'    => $this->get_item_name( $item ),
					)
				);
			}
			
			$wp_customize->add_section(
				'tetsuo_performance_shortcodes_section',
				array(
					'panel'       => 'tetsuo_performance',
					'priority'    => 30,
					'title'       => esc_html__( 'Shortcodes', 'tetsuo' ),
					'description' => esc_html__( 'Here you can select specific features to disable. Note that disabling certain features and functionalities which you will not be needing or which you are otherwise not utilizing in any way can have a positive effect to the overall performance of your site.', 'tetsuo' )
				)
			);
			
			$shortcodes = array();
			
			foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*', GLOB_ONLYDIR ) as $item ) {
				$shortcodes[ $this->get_item_class( $item ) ] = $this->get_item_name( $item );
			}
			
			if ( tetsuo_edge_is_woocommerce_installed() ) {
				foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*', GLOB_ONLYDIR ) as $item ) {
					$shortcodes[ $this->get_item_class( $item ) ] = $this->get_item_name( $item );
				}
			}
			
			foreach ( glob( TETSUO_CORE_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $item ) {
				$shortcodes[ $this->get_item_class( $item ) ] = $this->get_item_name( $item );
			}
			
			if ( ! empty( $shortcodes ) ) {
				ksort( $shortcodes );
				
				foreach ( $shortcodes as $key => $value ) {
					$wp_customize->add_setting(
						'tetsuo_performance_disable_shortcode_' . $key,
						array(
							'default'           => false,
							'type'              => 'option',
							'sanitize_callback' => array( $this, 'sanitize_checkbox' )
						)
					);
					
					$wp_customize->add_control(
						'tetsuo_performance_disable_cpt_' . $key,
						array(
							'section'  => 'tetsuo_performance_shortcodes_section',
							'settings' => 'tetsuo_performance_disable_shortcode_' . $key,
							'type'     => 'checkbox',
							'label'    => $value,
						)
					);
				}
			}
		}
	}
}

new TetsuoEdgeClassCustomizer();
