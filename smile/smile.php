<?php
/*
Plugin Name: Smile: The show more/less plug-in for Wordpress
Plugin URI: http://scalingexcellence.co.uk/smile-show-more-less
Description: Plugin for showing more/less with a simple tag
Author: Dimitrios Kouzis-Loukas
Author URI: http://dimitrioskouzisloukas.com
Version: 1.0
License: GPL2
*/

if ( preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF']) ) { die('You are not allowed to call this page directly.'); }

function sml_func( $atts, $content = '' )
{
    extract( shortcode_atts( array(
            'showmore' => 'show more...',
            'showless' => 'show less',
            'brackets' => '[|]',
            ), $atts ) );

    $brackets = explode('|', $brackets);
    
    return '<a class="smile more" href="#">'.$showmore.'</a><span style="display:none">'.do_shortcode($content).' '.$brackets[0].'<a class="smile less" href="#">'.$showless.'</a>'.$brackets[1].'</span>';
}

add_shortcode('smile', "sml_func");

function sml_head() {
?><script type="text/javascript">
jQuery(function($) {
    $(".smile.more").click(function() { $(this).hide().next().fadeIn(); return false; }).next();
    $(".smile.less").click(function() { $(this).parent().hide().prev().fadeIn(); return false; });
});
</script><?php
}

add_action('wp_head','sml_head');

?>
