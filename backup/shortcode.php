<?php
add_shortcode('hiyh_product_search', 'hiyh_product_search');
function hiyh_product_search(){
    return '<form class="woocommerce-product-search" role="search" action="/" method="get"><input id="woocommerce-product-search-field-0" class="search-field" name="s" type="search" value="" placeholder="'.__('Search products…','hiyh-store').'" /><button type="submit" value="'.__('Search','hiyh-store').'">'.__('Search','hiyh-store').'</button><input name="post_type" type="hidden" value="product" /></form>';
}

add_shortcode('hiyh_post_view','hiyh_post_view');
function hiyh_post_view($atts, $content=''){
    global $post, $paged;
    global $wp_query;
    echo $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $a = shortcode_atts( array(
        'type' => 'post',
        'title' => 1,
        'thumb' => 0,
        'excerpt' =>1,
        'more_text' => 'Read More',
        'length' => 50,
        'cat' => '',
        'nav' => 0,
        'count'=>-1,
        'key'=>'',
        'orderby' => 'date',
        'order'=>'DESC',
        'offset' => 0
    ), $atts );

    $args = array( 
        'post_type' => $a['type'],
        'posts_per_page' => 10,
        'showposts' =>10,
        //'post_status' => 'publish',
        'orderby'   => $a['orderby'], //or 'meta_value_num'
        
        );
    
    
    $more_text = $a['more_text'];
    $length = $a['length'];

    add_filter( 'excerpt_length', $length );
    add_filter( 'the_content_more_link', function(){
        return '[&hellip;] <a class="_self pt-cv-readmore btn btn-success" href="' . get_permalink() . '">'.$more_text.'</a>';
    } );
    add_filter('excerpt_more', function(){
        return '[&hellip;] <a class="_self pt-cv-readmore btn btn-success" href="' . get_permalink() . '">'.$more_text.'</a>';
    });

    if(!empty($a['count'])){
        $args['posts_per_page'] = $a['count'];
        $args['showposts'] = $a['count'];
    }
    if(!empty($a['orderby']) || ($a['orderby']=='meta_value' && !empty($a['key']) ) ){
            $args['orderby'] = $a['orderby'];
    }
    if(!empty($a['order'])){
        $args['order'] = $a['order'];
    }
    if(!empty($a['cat'])){
        $args['cat'] = $a['cat'];
    }
    if(!empty($a['nav'])){
        $args['paged'] = $paged;
    }else{
        //$args['nopaging'] = true;
    }
        
    $query = new WP_Query( $args );
    
    if($query->have_posts()):
        echo '<div class="pt-cv-wrapper">
                <div class="pt-cv-view pt-cv-grid pt-cv-colsys">
                    <div class="pt-cv-page" data-cvc="2">';
            while($query->have_posts()):
                $query->the_post();
                $plink = get_the_permalink();
                $author_link = ( get_the_author_meta('url') )? '<a href="' . esc_url(get_the_author_meta('url')) . '" rel="author">' . get_the_author() . '</a>' : '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a>';
                echo '<div class="col-md-6 pt-cv-content-item pt-cv-1-col">';
                if(!empty($a['title'])){
                    the_title( '<h4 class="pt-cv-title"><a href="'.$plink.'" class="_self" target="_self">', '</a></h4>' );

                    echo '<div class="pt-cv-meta-fields">
                            <span class="entry-date">
                                <time datetime="'.get_the_date('c').'" itempropf="datePublished">'.get_the_date( 'F j, Y' ).'</time>
                            </span> / <span class="author">by '.$author_link.'</span></div>';
                }

                echo '<div class="pt-cv-content">';

                    if ( $a['excerpt']==1 && has_excerpt() ){
                        $content = get_the_excerpt();
                    }else{
                        $content = get_the_content();
                    }
                    
                    echo wp_trim_words($content);
                    echo '<br><a class="_self pt-cv-readmore btn btn-success" href="' . get_permalink() . '">'.$more_text.'</a>';
                    
                echo '</div>';
                $i++;
                if($query->post_count!=$i) echo '';
                echo '</div>';
            endwhile;
            
        echo '</div></div></div>';
        $navigation = '';
        if(!empty($a['nav'])){
           echo  $total_pages = $query->max_num_pages;
            $big = 99999;
            if ($total_pages > 1){
                $current_page = max(1, get_query_var('paged'));
                $navigation .= '<nav id="results-nav" class="page-nav">';
                $navigation .= paginate_links(array(  
                    'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',  
                    'current'   => $current_page,  
                    'total'  => $total_pages,  
                    'prev_text' => 'Previous Case',  
                    'next_text' => 'Next Case' 
                ));
                $navigation .= '</nav>';
            }
            echo $navigation;
            echo '<style>#results-nav{display:block;clear:both;font-size: 8px;margin-top:20px;text-align:center}#results-nav .page-numbers {display: inline-block;font-size: 2rem;padding: 5px 10px;background: #f1f1f1;border-radius: 0;}</style>';
       }
    endif;
}

add_shortcode('xray_befor_after','xray_befor_after');
function xray_befor_after($atts, $content=''){
    global $paged;

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    // $paged = 3;
    $a = shortcode_atts( array(
        'title' => 1,
        'nav' => 0,
        'count'=> -1,
        'order'=> 'DESC'
    ), $atts );
    
    $args = array( 
        'post_type' => 'xray-result',
        // 'showposts' => $a['count'],
        'posts_per_page' => 10,
        'paged' => $paged,
        'no_found_rows' => false,
        'meta_key'=> 'result_case_num',
        'orderby'   => 'order_clause', //or 'meta_value_num'
        'order' => $a['order'],
        'meta_query' => array(
                            'order_clause' => array(
                                'key' => 'result_case_num',
                                'type' => 'NUMERIC'
                            )
                        )
        );


        

    $query = new WP_Query( $args );

  

    $args_count_posts = array( 
        'post_type' => 'xray-result',
        // 'showposts' => $a['count'],
        'posts_per_page' => -1,
        'paged' => $paged,
        'no_found_rows' => false,
        'meta_key'=> 'result_case_num',
        'orderby'   => 'order_clause', //or 'meta_value_num'
        'order' => $a['order'],
        'meta_query' => array(
                            'order_clause' => array(
                                'key' => 'result_case_num',
                                'type' => 'NUMERIC'
                            )
                        )
        );


    $query_count_posts= new WP_Query( $args_count_posts );
       
    $i =1;
    if($query->have_posts()):
        $return = '<div id="results" style="display:block;float:left;">';
            while($query->have_posts()):
                $query->the_post();
                if(!empty($a['title'])){
                    $return .= '<h3 class="inner-hedings">'.get_the_title( ).'</h3>';
                }

                $return .= get_the_content();
                $i++;
              
                if($query->post_count!=$i) $return .= '<hr>';
            endwhile;
            
        $return .= '</div>';
        wp_reset_postdata();
        $navigation = '';

     
   // if(!empty($a['nav'])){
    
            $published_posts =   $query_count_posts->post_count;
            $total_pages =  ceil($published_posts / 10);
            $big = 999999999;
            if ($total_pages > 1){
                $current_page = max(1, get_query_var('paged'));
                $navigation .= '<nav id="results-nav" class="page-nav">';
                $navigation .= paginate_links(array(  
                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',  
                    'current'   => $current_page,  
                    'total'     => $total_pages,  
                    'prev_text' => 'Previous Case',  
                    'next_text' => 'Next Case' 
                ));
                $navigation .= '</nav>';
            }
            $return .= $navigation;
            $return .= '<style>#results-nav{display:block;clear:both;font-size: 8px;margin-top:20px;text-align:center}#results-nav .page-numbers {display: inline-block;font-size: 2rem;padding: 5px 10px;background: #f1f1f1;border-radius: 0;}</style>';
      // }
      
	return $return;
  
    endif;
}

add_shortcode( 'header_icon', 'sc_header_icon' );
function sc_header_icon( $atts, $content='' ) {
    $a = shortcode_atts( array(
        'type' => 'location',
        'url' => '',
        'url_target' => ''
    ), $atts );

    if(!empty($a['url'])){
        return '<a href="'.esc_attr($a['url']).'" target-"'.esc_attr($a['url_target']).'" class="header-icon template-'.esc_attr($a['type']).'">'.$content.'</a>';
    }else{
        return '<span class="header-icon template-'.esc_attr($a['type']).'">'.$content.'</span>';
    }
}

add_shortcode( 'mc_icon', 'sc_mc_icon' );
function sc_mc_icon( $atts) {
    $a = shortcode_atts( array(
        'type' => 'social',
        'url' => '',
        'icon_social' => ''
    ), $atts );

    if(!empty($a['url'])){
        return '<a href="'.esc_attr($a['url']).'" target="_blank" class="icon-single mc-icon social-'.esc_attr($a['icon_social']).'" rel="noopener noreferrer"></a>';
    }else{
        return '<span class="icon-single mc-icon social-'.esc_attr($a['icon_social']).'"></span>';
    }
}

add_shortcode('mc_cart_icon', 'mc_cart_icon');
function mc_cart_icon($atts)
{
    extract(shortcode_atts(array(
        "cart_items_number" => "yes",
        "icon_target" => "",
        "class" => "",
    ), $atts));
    
    global $woocommerce;
    $result = "";
    if(is_plugin_active('woocommerce/woocommerce.php'))
    {
        ob_start();
        $cart_url = wc_get_cart_url();
        ?>
        <a <?php echo ($icon_target=="new_window" ? " target='_blank'" : ""); ?>href="<?php echo esc_url($cart_url);?>" class="template-cart <?php echo esc_attr($class);?>">&nbsp;<?php if($cart_items_number=="yes"): ?><span class="cart-items-number<?php echo (!(int)$woocommerce->cart->cart_contents_count ? ' cart-empty' : ''); ?>"><?php echo $woocommerce->cart->cart_contents_count; ?></span><?php endif;?></a>
        
        <?php
        $result = ob_get_clean();
    }
    return $result;
}
/*
[footer_banner_box box1_icon='map' box1_h='Find a clinic near you' box1_link='https://www.google.com/maps/place/Tong+Building/@1.304029,103.834769,16z/data=!4m5!3m4!1s0x0:0xc0febfc7d057c4a!8m2!3d1.3040294!4d103.8347691?hl=en-US' box1_text='Find Us On Map' box2_icon='phone' box2_h='Call for an appointment!' box2_link='tel:+6566352550' box2_text='(+65) 6635 2550' box3_icon='email' box3_h='Call for an appointment!' box3_link='tel:+6566352550' box3_text='(+65) 6635 2550']
*/
add_shortcode('footer_banner_box', 'footer_banner_box');
function footer_banner_box($atts){
    $a = shortcode_atts(array(
            'box1_icon'=>'map',
            'box1_h'=>'',
            'box1_text'=>'',
            'box1_link'=>'',
            'box1_target'=>'',
            'box2_icon'=>'phone',
            'box2_h'=>'',
            'box2_text'=>'',
            'box2_link'=>'',
            'box2_target'=>'',
            'box3_icon'=>'email',
            'box3_h'=>'',
            'box3_text'=>'',
            'box3_link'=>'',
            'box3_target'=>''
        ),$atts);
        $icon1 = esc_attr($a['box1_icon']);
        $icon2 = esc_attr($a['box2_icon']);
        $icon3 = esc_attr($a['box3_icon']);
        $text1 = !empty($a['box1_link'])? '<p class="content-margin"><a href="'.esc_attr($a['box1_link']).'" target="_blank">'.get_option('find_us_map').'</a></p>': '<p class="content-margin">'.get_option('find_us_map').'</p>';
        // $text1 = !empty($a['box1_link'])? '<p class="content-margin"><a href="'.esc_attr($a['box1_link']).'" target="_blank">'.esc_attr($a['box1_text']).'</a></p>': '<p class="content-margin">'.esc_attr($a['box1_text']).'</p>';
        $text2 = !empty($a['box2_link'])? '<p class="content-margin"><a href="'.esc_attr($a['box2_link']).'" target="_blank">'.esc_attr($a['box2_text']).'</a></p>': '<p class="content-margin">'.esc_attr($a['box2_text']).'</p>';
        // $text2 = !empty($a['box2_link'])? '<p class="content-margin"><a href="'.esc_attr($a['box2_link']).'" target="_blank">'.get_option('call_for_appoint').'</a></p>': '<p class="content-margin">'.get_option('call_for_appoint').'</p>';
        $text3 = !empty($a['box3_link'])? '<p class="content-margin"><a href="'.esc_attr($a['box3_link']).'" target="_blank">'.esc_attr($a['box3_text']).'</a></p>': '<p class="content-margin">'.esc_attr($a['box3_text']).'</p>';
        $output = '';
        if(!empty($a['box1_h']) || !empty($a['box2_h']) || !empty($a['box3_h'])){
            $output .= '<ul class="footer-banner-box-container clearfix">';
            
            $output .= '<li class="footer-banner-box features-'.$icon1.' animated-element animation-fadeIn duration-500" hiyh-animation-type="fadeIn"><h2>'.get_option('find_clinic').'</h2>'.$text1.'</li>';
            
            $output .= '<li class="footer-banner-box features-'.$icon2.' animated-element animation-slideRight duration-800 delay-250" hiyh-animation-type="slideRight"><h2>'.get_option('call_for_appoint').'</h2>'.$text2.'</li>';
            
            $output .= '<li class="footer-banner-box features-'.$icon3.' animated-element animation-slideRight200 duration-800 delay-500" hiyh-animation-type="slideRight200"><h2>'.get_option('feel_free_message').'</h2>'.$text3.'</li>';

            
            $output .= '</ul>';
        }
        return $output;
}

add_shortcode('popup_subscribe','popup_subscribe');
function popup_subscribe($atts, $content){
    $a = shortcode_atts(array(
        'src'=> '',
        'h3'=>'JOIN OUR MAILING LIST.',
        'p'=>'Be the first to learn about health and scoliosis research and special events.',
        'btn'=>'Subscribe'
        ),$atts);

        $email = __('Email Address','hiyh-store');
        if(!emptY($a['src']) || !emptY($a['h3']) || !emptY($a['src']) || !emptY($content)){
            return '<div id="nl-box"><div id="nl-overlay"></div><div id="nl-container"><div class="nl-inner"><div class="nl-left"><img src="'.esc_attr($a['src']).'" alt="subscribe"></div><div class="nl-right">
                <span class="close-btn"> </span>
                <h3>'.esc_attr($a['h3']).'</h3><p>'.esc_attr($a['p']).'</p>'.str_replace('email address',$email, do_shortcode($content)).'<input type="hidden" id="button" value="'.esc_attr($a['btn']).'">
            </div>
        </div>
    </div>
</div>';
        }
}


add_shortcode('newsletter_subscribe','newsletter_subscribe');
function newsletter_subscribe($atts, $content){
    $a = shortcode_atts(array(
        'h3'=>'JOIN OUR MAILING LIST.',
        'p'=>'Be the first to learn about health and scoliosis research and special events.',
        'btn'=> 'Subscribe',
        'placeholder' => 'Email Address'
        ),$atts);

        $email = __($a['placeholder'],'hiyh-store');
        if(!emptY($a['src']) || !emptY($a['h3']) || !emptY($a['src']) || !emptY($content)){
            return '<div class="footer_newsletter_form"><div class="mailchimp_form_shortcode"><h1>'.esc_attr($a['h3']).'</h1><p>'.esc_attr($a['p']).'</p><div class="mp_form">'.str_replace('email address',$email, do_shortcode($content)).'<input type="hidden" id="subscribe_btn_val" value="'.esc_attr($a['btn']).'"/></div></div></div></div>';
        }
}



add_shortcode('whatshelp','whatshelp');
function whatshelp($atts){
     $a = shortcode_atts(array(
        'facebook'=> '',
        'whatsapp'=>'',
        'email'=>'',
        'sms'=>'',
        'call'=>'',
        'company_logo_url'=>'',
        'greeting_message'=>'Hello, how may we help you? Just send us a message now to get assistance.',
        'call_to_action'=>'Message us',
        'button_color'=>'#FF6550',
        'position'=>'right',
        'order'=> 'facebook,whatsapp,call,sms,email'
        ),$atts);
        $fb = !empty($a['facebook']) ? 'facebook: "'.esc_attr($a['facebook']).'",' : '';
        $wa = !empty($a['whatsapp']) ? 'whatsapp: "'.esc_attr($a['whatsapp']).'",' : '';
        $email = !empty($a['email'])? 'email: "'.esc_attr($a['email']).'",' : '';
        $sms = !empty($a['sms'])? 'sms: "'.esc_attr($a['sms']).'",' : '';
        $call = !empty($a['call'])? 'call: "'.esc_attr($a['call']).'",' : '';
        
        $logo = !empty($a['company_logo_url'])? esc_attr($a['company_logo_url']) : get_template_directory_uri().'/images/logo-w.png';
        $greeting = !empty($a['greeting_message'])? esc_attr($a['greeting_message']):'Hello, how may we help you?';
        $c2a = !empty($a['call_to_action'])? esc_attr($a['call_to_action']) : 'Message us';
        $bc = !empty($a['button_color'])? esc_attr($a['button_color']) : '#FF6550';
        $position = !empty($a['position'])? esc_attr($a['position']) : 'right';
        $order = !empty($a['order'])? esc_attr($a['order']):'facebook,whatsapp,call,sms,email';
            
            return '<script type="text/javascript">
    (function () {
        var options = {
            '.$fb.$wa.$email.$sms.$call.'
            company_logo_url: "'.$logo.'",
            greeting_message: "'.$greeting.'",
            call_to_action: "'.$c2a.'",
            button_color: "'.$bc.'",
            position: "'.$position.'",
            order: "'.$order.'"
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement("script"); s.type = "text/javascript"; s.async = true; s.src = url + "/widget-send-button/js/init.js";
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName("script")[0]; x.parentNode.insertBefore(s, x);
    })();
</script>';

}

add_shortcode('fb_likebox', 'fb_likebox');
function fb_likebox($atts){
    $a = shortcode_atts(array(
        'title'=>'LIKE US ON FACEBOOK',
        'page_url'=>'https://www.facebook.com/HealthInYourHands',
        'height'=>'',
        'width'=>'500',
        'header'=>'true',
        'cover'=>'true',
        'facepile'=>'false',
        'blockquote'=>'Scoliosis & Spine Correction Clinic - Health In Your Hands'
        ),$atts);
    
    return '<h2 class="widget-title">'.esc_attr($a['title']).'</h2>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id; js.async = true;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));
</script>
<style>#fb-root {display: none;}.fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget iframe{ width: 100% !important; }</style>
<div id="fblikebox-container" style="width:100%"><div class="fb-page" data-href="'.esc_attr($a['page_url']).'" data-tabs="timeline" data-width="'.esc_attr($a['width']).'" data-height="380" data-small-header="'.esc_attr($a['header']).'" data-adapt-container-width="true" data-hide-cover="'.esc_attr($a['cover']).'" data-show-facepile="'.esc_attr($a['facepile']).'"><div class="fb-xfbml-parse-ignore"><blockquote cite="'.esc_attr($a['page_url']).'"><a href="'.esc_attr($a['page_url']).'">'.esc_attr($a['blockquote']).'</a></blockquote></div></div></div>';
}


add_shortcode('weibo_frame', 'weibo_frame');
function weibo_frame($atts){
    $a = shortcode_atts(
          array(
            'title' => 'Weibo',
            'uid'=>0,
            'border' => 0,
            'height'=>'360',
            'width'=>'420'
          ), $atts);

    return '<h2 class="widget-title">'.esc_attr($a['title']).'</h2><iframe class="share_self" src="//widget.weibo.com/weiboshow/index.php?language=&width='.esc_attr($a['width']).'&height='.esc_attr($a['height']).'&fansRow=1&ptype=1&speed=0&skin=5&isTitle=0&noborder=1&isWeibo=1&isFans=0&uid='.esc_attr($a['uid']).'&verifier=5c3c0936&dpc=1" width="'.esc_attr($a['width']).'" height="'.esc_attr($a['height']).'" frameborder="'.esc_attr($a['border']).'" scrolling="no"></iframe>';
}

add_shortcode('buying_options', 'hiyh_store_buying_options');
function hiyh_store_buying_options($atts){
    $a = shortcode_atts(
          array(
            'amazon' => '',
            'lazada'=>'',
            'qoo10' => '',
            'nulisbuku'=>'',
            'taobao'=>'',
            'ibooks'=>'',
            'play'=>''
          ), $atts);

    return get_buy_opt(array('amazon'=>$a['amazon'], 'nulisbuku'=>$a['nulisbuku'], 'lazada'=>$a['lazada'], 'qoo10'=>$a['qoo10'],'taobao'=>$a['taobao'], 'ibooks'=>$a['ibooks'],'play'=>$a['play']) );
}
add_shortcode('buying_options2', 'hiyh_store_buying_options2');
function hiyh_store_buying_options2($atts){
    $a = shortcode_atts(
          array(
            'amazon' => '',
            'lazada'=>'',
            'qoo10' => '',
            'nulisbuku'=>'',
            'taobao'=>'',
            'ibooks'=>'',
            'play'=>'',
            'kindle'=>'',
            'lang'=>'en'
          ), $atts);
    global $product;
    $lc = array(
            'de'=>'german',
            'en'=>'english',
            'es'=>'spanish',
            'fr'=>'french',
            'zh'=>'chinese',
            'cn'=>'chinese',
            'hk'=>'chinese',
            'it'=>'italian',
            'id'=>'indonesian',
            'ja'=>'japanese',
            'jp'=>'japanese',
            'ko'=>'korean',
            'kr'=>'korean',
            );
    $amazon = $a['amazon'];
    $nubuki = $a['nulisbuku'];
    $lazada = $a['lazada'];
    $q10 = $a['qoo10'];
    $taobao = $a['taobao'];
    $play=$a['play'];
    $ibooks = $a['ibooks'];
    $kindle = $a['kindle'];
    $lang = $a['lang'];
    
    $country = array("AU"=>"Australia","CA"=>"Canada","CN"=>"China","IN"=>"India","ID"=>"Indonesia","IT"=>"Italy","JP"=>"Japan","KO"=>"Korea","MY"=>"Malaysia","NZ"=>"New zealand","SG"=>"Singapore","UK"=>"United Kingdom","US"=>"USA","DE"=>"German","ES"=>"Spain","FR"=>"France","HK"=>"Hong Kong",'MX'=>"Mexico");
    asort($country);
    
    $button_dir_url = esc_url( get_template_directory_uri() ).'/images/buying-logo/';
    $flag_dir_url = esc_url( get_template_directory_uri() ).'/images/flag/';
    
    $opt = '';
    $buy_tab_content = '';

    foreach($country as $c=>$v){

        $flag = $flag_dir_url.strtolower($c).'.png';
        
        $amazon_link = 'https://amazon.com';
        $ibooks_link = 'http://books.apple.com/us/book/id';
        if($c=='CA'){
            $amazon_link = 'https://amazon.ca';
            $ibooks_link = 'http://books.apple.com/ca/book/id';
        }
        if($c=='DE'){
            $amazon_link = 'https://amazon.de';
            $ibooks_link = 'http://books.apple.com/de/book/id';
        }
        if($c=='AU'){
            $amazon_link = 'https://amazon.com.au';
            $ibooks_link = 'http://books.apple.com/au/book/id';
        }
        if($c=='IT'){
            $amazon_link = 'https://amazon.it';
            $ibooks_link = 'http://books.apple.com/it/book/id';
        }
        if($c=='IN'){
            $amazon_link = 'https://amazon.in';
        }
        if($c=='UK'){
            $amazon_link = 'https://amazon.co.uk';
        }
        if($c=='ES'){
            $amazon_link = 'https://amazon.es';
            $ibooks_link = 'http://books.apple.com/es/book/id';
        }
        if($c=='FR'){
            $amazon_link = 'https://amazon.fr';
            $ibooks_link = 'http://books.apple.com/fr/book/id';
        }
        if($c=='MX'){
            $amazon_link = 'https://amazon.com.mx';
            $ibooks_link = 'http://books.apple.com/mx/book/id';
        }
        if($c=='JP'){
            $amazon_link = 'https://amazon.co.jp';
            $ibooks_link = 'http://books.apple.com/jp/book/id';
        }
        $kindle_link = $amazon_link.'/dp/'.$kindle;
        $amazon_link = $amazon_link.'/dp/'.$amazon;
        $taobao_link = 'https://item.taobao.com/item.htm?id='.$taobao;
        $lazada_link = 'https://www.lazada.sg/products/'.$lazada.'.html';
        $nubuki_link = 'http://nulisbuku.com/books/view_book/'.$nubuki;
        $q10_link = 'https://www.qoo10.sg/item/id/'.$q10;
        $play_link = 'https://play.google.com/store/books/details?id='.$play;
        $ibooks_link = $ibooks_link.$ibooks;

        if($c=='CN' || $c=='HK'){
            $button = (!empty($taobao)) ? '<a href="'.$taobao_link.'" target="_blank" rel="nofollow" title="Taobao"><img src="'.$button_dir_url.'taobao.jpg" alt="Taobao" /></a>' : '';
            $button2 = (!empty($q10)) ? '<a href="'.$q10_link.'" target="_blank" rel="nofollow" title="Qoo10"><img src="'.$button_dir_url.'qoo10.jpg" alt="Qoo10" /></a>' : '';
        }elseif($c=='SG'){
            $button = (!empty( $lazada )) ? '<a href="'. $lazada_link .'" target="_blank" rel="nofollow" title="Lazada"><img src="'.$button_dir_url.'lazada.jpg" alt="Lazada" /></a>' : '';
            $button2 = (!empty($q10)) ? '<a href="'.$q10_link.'" target="_blank" rel="nofollow" title="Qoo10"><img src="'.$button_dir_url.'qoo10.jpg" alt="Qoo10" /></a>' : '';
            
        }elseif($c=='ID'){
            $button = (!empty($nubuki)) ? '<a href="'.$nubuki_link.'" target="_blank" rel="nofollow" title="Nulisbuku"><img src="'.$button_dir_url.'nulisbuku.jpg" alt="Nulisbuku" /></a>' : '';
            $button2_ = (!empty($amazon)) ? '<a href="'.$amazon_link.'" target="_blank" rel="nofollow" title="Amazon"><img src="'.$button_dir_url.'amazon.jpg" alt="Amazon" /></a>' : '';
            $button2__ = (!empty($q10)) ? '<a href="'.$q10_link.'" target="_blank" rel="nofollow" title="Qoo10"><img src="'.$button_dir_url.'qoo10.jpg" alt="Qoo10" /></a>' : '';
            $button2 = $button2_.$button2__;
            $button5 = (!empty($kindle)) ? '<a href="'.$kindle_link.'" target="_blank" rel="nofollow" title="Amazon Kindle"><img src="'.$button_dir_url.'kindle.jpg" alt="Kindle" /></a>' : '';
        }else{
            
            //$button = (!empty($amazon)) ? '<a href="'.$amazon.'"><img src="'.$button_dir_url.'amazon.jpg" alt="Amazon" /></a>' : '';
            $button = (!empty($amazon)) ? '<a href="'.$amazon_link.'" target="_blank" rel="nofollow" title="Amazon"><img src="'.$button_dir_url.'amazon.jpg" alt="Amazon" /></a>' : '';
            $button5 = (!empty($kindle)) ? '<a href="'.$kindle_link.'" target="_blank" rel="nofollow" title="Amazon Kindle"><img src="'.$button_dir_url.'kindle.jpg" alt="Kindle" /></a>' : '';
            $button2__ = (!empty($q10)) ? '<a href="'.$q10_link.'" target="_blank" rel="nofollow" title="Qoo10"><img src="'.$button_dir_url.'qoo10.jpg" alt="Qoo10" /></a>' : '';
            $button2 = ($c=='KO' || $c=='MY')? $button2__:'';
        }
        $button3 = (!empty($play))? '<a href="'.$play_link.'" target="_blank" rel="nofollow" title="Google Play"><img src="'.$button_dir_url.'play.jpg" alt="Google Play" /></a>' : '';
        $button4 = (!empty($ibooks))? '<a href="'.$ibooks_link.'" target="_blank" rel="nofollow" title="iBooks"><img src="'.$button_dir_url.'ibooks.jpg" alt="iBooks" /></a>' : '';
        
        $buy_tab_content .= '<li data-content="'.$c.'" class="boc-button" style="display:none">'.$button.$button2.$button3.$button4.$button5.'</li>';
    }
    
    //ICL_LANGUAGE_CODE
    $pattribute = 'pa_language';
    $pterm = $product->get_attribute( $pattribute );
    
    $terms = wc_get_product_terms( $product->id, $pattribute, array( 'fields' => 'all' ) );
    $langAttr = array();
    foreach($terms as $term){
        $langAttr[] = array($term->slug=>$term->name);
    }
    $contlang = $a['lang'];
    $datalang = $lc[$contlang];
    $content = '<div class="boc-flag-opt-content boc-lang-hide" data-lang="'.$datalang.'">'.$buy_tab_content.'</div>';

    return $content;

}
add_shortcode('get_country_opt', 'hiyh_store_get_countryopt');
function hiyh_store_get_countryopt($atts){
    $country = array("AU"=>"Australia","CA"=>"Canada","CN"=>"China","IN"=>"India","ID"=>"Indonesia","IT"=>"Italy","JP"=>"Japan","KO"=>"Korea","MY"=>"Malaysia","NZ"=>"New zealand","SG"=>"Singapore","UK"=>"United Kingdom","US"=>"USA","DE"=>"German","ES"=>"Spain","FR"=>"France","HK"=>"Hong Kong",'MX'=>"Mexico");
    asort($country);
    $button_dir_url = esc_url( get_template_directory_uri() ).'/images/buying-logo/';
	$flag_dir_url = esc_url( get_template_directory_uri() ).'/images/flag/';
	
    $opt = '';
    foreach($country as $c=>$v){
        $flag = $flag_dir_url.strtolower($c).'.png';
        $opt .= '<li class="boc-item-legacy-dropdown boc-item-click" onclick="get_boc_item(jQuery(this), \''.$c.'\')"><img src="'.$flag.'" alt="'.$c.'" title="China" class="wpml-ls-flag iclflag" /> '.$v.'</li>';
    }
    $opt = '<strong>'.__('Select Country', 'hiyh-store').':</strong><ul id="select-country-dropdown"><li class="boc-item-legacy-dropdown" data-item="0"><a href="#" class="boc-select" onclick="boc_item_toggle();return false;">Select...</a><ul class="boc-sub-menu">'.$opt.'</ul></li></ul>';
    return '<div class="boc-flag-opt" style="display: inline-block;vertical-align: middle;">'.$opt.'</div>';
}

function no_rows_found_function($query)
{ 
  $query->set('no_found_rows', true); 
  wc_set_loop_prop( 'total', 17 );
}

add_action('pre_get_posts', 'no_rows_found_function');




add_shortcode('results_you_see', 'hiyh_store_results_you_can_see');
function hiyh_store_results_you_can_see(){

      $my_current_lang = apply_filters( 'wpml_current_language', NULL );

      switch($my_current_lang ){
        case 'en_NZ' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'en_AU' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'en_CA' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'en_IN' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'en_MY' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'en_NZ' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'en_SG' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'en_UK' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'en_US' :
            $imgpath = 'Can-See-2-EN.png';
        break;
        case 'es_US' :
            $imgpath = 'Can-See-2-ES.png';
        break;
        case 'es_ES' :
            $imgpath = 'Can-See-2-ES.png';
        break;
        case 'es_MX' :
            $imgpath = 'Can-See-2-ES.png';
        break;
        case 'fr_CA' :
            $imgpath = 'Can-See-2-FR.png';
        break;
        case 'fr_FR' :
            $imgpath = 'Can-See-2-FR.png';
        break;
        case 'it_IT' :
            $imgpath = 'Can-See-2-IT.png';
        break;
        case 'zh_CN' :
            $imgpath = 'Can-See-2-CNS.png';
        break;
        case 'zh_HK' :
            $imgpath = 'Can-See-2-CNT.png';
        break;
        case 'cn_SG' :
            $imgpath = 'Can-See-2-CNS.png';
        break;
        case 'ja_JP' :
            $imgpath = 'Can-See-2-JP.png';
        break;
        case 'ko_KR' :
            $imgpath = 'Can-See-2-KO.png';
        break;
        default:
            $imgpath = 'Can-See-2-EN.png';
        break;
      }

      return "<img src='".site_url()."/wp-content/uploads/2021/07/$imgpath'/>";
    
}


// add_shortcode('order_id_skypeform', 'hiyh_store_order_id_skypeform');
// function hiyh_store_order_id_skypeform(){
// $k = $_GET['oid'];
//     return $k;
// }


