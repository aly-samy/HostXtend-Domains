<?php

/**
 * Class with (default) settings.
 */
class HOSTXTEND_DOMAIN_CHECK_Options {

	/**
	 * @var object Options instance.
	 */
	private static $instance = null;
	/**
	 * @var array Default options.
	 */
	private $options_default;

	/**
	 * Constructor.
	 * 
	 * @return void
	 */
	private function __construct() {
		// init default options
		$this->options_default = array(
			'fieldLabel'			=> 'www.',
			'fieldPlaceholder'		=> __( 'desired-domain', 'hostxtend-domain-check' ),
			'fieldWidth'			=> 250,
			'fieldUnit'				=> 'px',
			'fieldnameDomain'		=> 'domaincheck_domain',
			'fieldnameTld'			=> 'domaincheck_tld',
			'selectionType'			=> 'dropdown',
			'tlds'					=> 'com, net, org, info, eu, de, uk, nl, br, fr, it, ca, pl',
			'checkAll'				=> true,
			'checkAllLabel'			=> __( 'all', 'hostxtend-domain-check' ),
			'checkAllDefault'		=> false,
			'multicheck'			=> false,
			'textButton'			=> __( 'check', 'hostxtend-domain-check' ),
			'showWhois'				=> false,
			'textWhois'				=> __( 'whois', 'hostxtend-domain-check' ),
			'displayType'			=> 'default',
			'excludeRegistered'		=> false,
			'textNoResults'			=> __( 'No free domain found.', 'hostxtend-domain-check' ),
			'displayLimit'			=> 0,
			'textLoadMore'			=> __( 'more', 'hostxtend-domain-check' ),
			'textAvailable'			=> __( 'is available', 'hostxtend-domain-check' ),
			'colorAvailable'		=> '#008b00',
			'textRegistered'		=> __( 'is registered', 'hostxtend-domain-check' ),
			'colorRegistered'		=> '',
			'textError'				=> __( 'error', 'hostxtend-domain-check' ),
			'colorError'			=> '#8c0000',
			'textInvalid'			=> __( 'is invalid', 'hostxtend-domain-check' ),
			'colorInvalid'			=> '#8c0000',
			'textLimit'				=> __( 'query limit reached', 'hostxtend-domain-check' ),
			'colorLimit'			=> '#ff8c00',
			'textWhoisserver'		=> __( 'whois server unknown', 'hostxtend-domain-check' ),
			'colorWhoisserver'		=> '#8c0000',
			'textUnsupported'		=> __( '.[tld] is not supported', 'hostxtend-domain-check' ),
			'colorUnsupported'		=> '#ff8c00',
			'textTldMissing'		=> __( 'Please enter a domain extension', 'hostxtend-domain-check' ),
			'colorTldMissing'		=> '',
			'textEmptyField'		=> '',
			'colorEmptyField'		=> '',
			'textInvalidField'		=> '',
			'colorInvalidField'		=> '',
			'priceEnabled'			=> false,
			'priceDefault'			=> '',
			'linkEnabled'			=> false,
			'linkDefault'			=> '',
			'textPurchase'			=> __( '[link]buy now[/link] for [price]', 'hostxtend-domain-check' ),
			'priceTransferEnabled'	=> false,
			'priceTransferDefault'	=> '',
			'linkTransferEnabled'	=> false,
			'linkTransferDefault'	=> '',
			'textTransfer'			=> __( '[link]transfer now[/link] for [price]', 'hostxtend-domain-check' ),
			'prefixes'				=> '',
			'suffixes'				=> '',
			'linkRegistered'		=> false,
			'dotInSelect'			=> false,
			'useNonces'				=> false,
			'multipleUse'			=> false,
			'htmlForm'				=> true,
			'removeWhoisComments'	=> false,
			'hooksEnabled'			=> false,
			'wcHooksEnabled'		=> false,
			'reviewMessage'			=> true,
			'overrideWhoisservers'	=> false,
		);

		// unsupported tlds
		$this->options_default['unsupported'] = array(
			'enabled'		=> false,
			'text'			=> __( 'is probably available', 'hostxtend-domain-check' ),
			'color'			=> '#008b00',
			'verify'		=> false,
			'verifyText'	=> __( 'verify', 'hostxtend-domain-check' ),
		);

		// woocommerce options
		$this->options_default['woocommerce'] = array(
			'enabled'				=> false,
			'addToCartBehaviour'	=> 0,
			'customPageLink'		=> '',
			'addToCartText'			=> __( 'add to cart', 'hostxtend-domain-check' ),
			'addedToCartText'		=> __( 'added to cart', 'hostxtend-domain-check' ),
			'domainLabel'			=> __( 'Domain', 'hostxtend-domain-check' ),
			'productidPurchase'		=> 0,
			'textPurchase'			=> __( '[link]buy now[/link] for [price]', 'hostxtend-domain-check' ),
			'transferEnabled'		=> false,
			'productidTransfer'		=> 0,
			'textTransfer'			=> __( '[link]transfer now[/link] for [price]', 'hostxtend-domain-check' ),
			'suffixTransfer'		=> __( '(Transfer)', 'hostxtend-domain-check' ),
		);

		// recaptcha options
		$this->options_default['recaptcha'] = array(
			'type'		=> 'none',
			'siteKey'	=> '',
			'secretKey'	=> '',
			'theme'		=> 'light',
			'size'		=> 'normal',
			'position'	=> 'bottomright',
			'score'		=> 0.5,
			'text'		=> __( 'reCAPTCHA check failed', 'hostxtend-domain-check' ),
			'color'		=> '#8c0000',
		);

		// query limit options
		$this->options_default['query_limits'] = array(
			'centralnic'	=> 60,
		);
	}

	/**
	 * Get options instance.
	 * 
	 * @return object Options instance.
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new HOSTXTEND_DOMAIN_CHECK_Options();
		}
		return self::$instance;
	}

	/**
	 * Get Options.
	 * 
	 * @return array Options.
	 */
	public function get_options() {
		$options = get_option( 'wp24_domaincheck' );
		if ( '' === $options || ! is_array( $options ) )
			return $this->options_default;

		// backward compatibility with v1.8.1
		if ( ! isset( $options['woocommerce']['addToCartBehaviour'] ) && $options['woocommerce']['redirectToCart'] )
			$options['woocommerce']['addToCartBehaviour'] = 0;

		// merge options with defaults if single options missing
		return array_merge( $this->options_default, $options );
	}

}
