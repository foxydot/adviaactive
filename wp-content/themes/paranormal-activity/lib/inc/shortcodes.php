<?php
add_shortcode('button','msdlab_button_function');
function msdlab_button_function($atts, $content = null){	
	extract( shortcode_atts( array(
      'url' => null,
	  'target' => '_self'
      ), $atts ) );
      if(strstr($url,'mailto:',0)){
          $parts = explode(':',$url);
          if(is_email($parts[1])){
              $url = $parts[0].':'.antispambot($parts[1]);
          }
      }
	$ret = '<div class="button-wrapper">
<a class="button" href="'.$url.'" target="'.$target.'">'.remove_wpautop($content).'</a>
</div>';
	return $ret;
}
add_shortcode('hero','msdlab_landing_page_hero');
function msdlab_landing_page_hero($atts, $content = null){
	$ret = '<div class="hero">'.remove_wpautop($content).'</div>';
	return $ret;
}
add_shortcode('callout','msdlab_landing_page_callout');
function msdlab_landing_page_callout($atts, $content = null){
	$ret = '<div class="callout">'.remove_wpautop($content).'</div>';
	return $ret;
}
function column_shortcode($atts, $content = null){
	extract( shortcode_atts( array(
	'cols' => '3',
	'position' => '',
	), $atts ) );
	switch($cols){
		case 5:
			$classes[] = 'one-fifth';
			break;
		case 4:
			$classes[] = 'one-fouth';
			break;
		case 3:
			$classes[] = 'one-third';
			break;
		case 2:
			$classes[] = 'one-half';
			break;
	}
	switch($position){
		case 'first':
		case '1':
			$classes[] = 'first';
		case 'last':
			$classes[] = 'last';
	}
	return '<div class="'.implode(' ',$classes).'">'.$content.'</div>';
}
add_shortcode('mailto','msdlab_mailto_function');
function msdlab_mailto_function($atts, $content){
    extract( shortcode_atts( array(
    'email' => '',
    ), $atts ) );
    $content = trim($content);
    if($email == '' && preg_match('|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}|i', $content, $matches)){
        $email = $matches[0];
    }
    $email = antispambot($email);
    return '<a href="mailto:'.$email.'">'.$content.'</a>';
}

add_shortcode('columns','column_shortcode');

add_shortcode('sitemap','msdlab_sitemap');

if(!function_exists('msdlab_team_list')){
    function msdlab_team_list($return = TRUE){
        $ret = '';
        
        $loop = new WP_Query( array( 'post_type' => 'teammember', 'posts_per_page' => -1, 'sort' => 'post_title', 'order' => 'asc' ) );
        while ( $loop->have_posts() ) : $loop->the_post();
            $ret .= '
            <li>
                <div class="wrap row">
                    <div class="team-photo col-md-3">
                        <img src="'.get_field("bio_photo").'" alt="'.get_field("person").'"/>
                    </div>
                    <div class="team-info col-md-9">
                        <h2>
                            '.get_field("person").'
                        </h2>
                        <h3>
                            '.get_field("title").'
                        </h3>
                        <div class="team-line orange-bkg"></div>
                        <p class="shown">
                            '.get_field("biosnippet").'
                        </p>
                        <p style="display: none">
                            '.get_field("bioexpand").'
                        </p>
                        <div class="more-button">More ></div>
                    </div>
                    </div>
                </li>
                ';
            endwhile; 
        wp_reset_query();
            
        $ret = '<ul class="our-team-list">'.$ret.'</ul>';
        return $ret;
    } 
}
    


add_shortcode('team','msdlab_team_list');