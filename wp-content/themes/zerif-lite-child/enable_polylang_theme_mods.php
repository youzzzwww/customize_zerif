<?php

add_action('wp_loaded', 'register_translation_strings');
add_action('wp_loaded', 'add_output_translations');

function register_translation_strings() {
	$all_translations = array('zerif_bigtitle_title'=>false,
			'zerif_bigtitle_redbutton_label'=>false,
			'zerif_bigtitle_greenbutton_label'=>false,
			'zerif_ourfocus_title'=>false,
			'zerif_ourfocus_subtitle'=>false,
			'zerif_aboutus_title'=>false,
			'zerif_aboutus_subtitle'=>false,
			'zerif_aboutus_biglefttitle'=>false,
			'zerif_aboutus_text'=>true,
			'zerif_aboutus_clients_title_text'=>false,
			'zerif_ourteam_title'=>false,
			'zerif_ourteam_subtitle'=>false,
			'zerif_testimonials_title'=>false,
			'zerif_testimonials_subtitle'=>false,
			'zerif_latestnews_title'=>false,
			'zerif_latestnews_subtitle'=>false,
			'zerif_bottomribbon_text'=>true,
			'zerif_bottomribbon_buttonlabel'=>false,
			'zerif_ribbonright_text'=>true,
			'zerif_ribbonright_buttonlabel'=>false,
			'zerif_contactus_title'=>false,
			'zerif_contactus_subtitle'=>false,
			'zerif_contactus_button_label'=>false,
			'zerif_address'=>true,
			'zerif_copyright'=>false
			);

	foreach ($all_translations as $translation => $is_multiline):
		if ( $translate_str = get_theme_mod($translation) ):
			pll_register_string($translation, $translate_str,
					'zerif-lite', $is_multiline);
		endif;
	endforeach;
}

function add_output_translations() {
	add_filter('pre_kses', function ( $out_string ) {
			return pll__($out_string);
			});
}

?>
