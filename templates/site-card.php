<?php
/*
 * @Theme Name:WebStack
 * @Theme URI:https://56world.pp.ua
 * @Author: Midou
 * @Author URI: https://56world.pp.ua
 * @Date: 2019-02-22 21:26:02
 * @LastEditors: Midou
 * @LastEditTime: 2023-02-20 19:36:41
 * @FilePath: \WebStack\templates\site-card.php
 * @Description: 
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }  ?>

            <?php
            $title = $link_url;
            $is_html = '';
            $tooltip = 'data-toggle="tooltip" data-placement="bottom"';
            if(get_post_meta($post->ID, '_wechat_qr', true)){
                $title="<img src='" . get_post_meta(get_the_ID(), '_wechat_qr', true) . "' width='128'>";
                $is_html = 'data-html="true"';
            } else {
                switch(io_get_option('po_prompt')) {
                    case 'null':  
                        $title = get_the_title();
                        $tooltip = '';
                        break;
                    case 'url': 
                        if($link_url=="")
                            $title = __('地址错误！','i_theme');
                        break;
                    case 'summary':
                        $title = get_post_meta($post->ID, '_sites_sescribe', true);
                        break;
                    case 'qr':
                        if($link_url=="")
                            $title = __('地址错误！','i_theme');
                        else{
                            $title = "<img src='//api.qrserver.com/v1/create-qr-code/?size=150x150&margin=10&data=" . $link_url . "' width='128'>";
                            $is_html = 'data-html="true"';
                        }
                        break;
                    default: 
                } 
            }
            $url = '';
            $blank = '_blank';
            if(io_get_option('details_page')){ 
                $url=get_permalink();
            }else{ 
                if($link_url==""){
                    $url = 'javascript:';
                    $blank = '';
                }else{
                    if(io_get_option('is_go'))
                        $url = home_url().'/go/?url='.base64_encode($link_url) ;
                    else
                        $url = $link_url;
                }
            } 

            ?>
            <a href="<?php echo $url ?>" target="<?php echo $blank ?>" class="xe-widget xe-conversations box2 label-info" <?php echo $tooltip . ' ' . $is_html ?> title="<?php echo $title ?>">
                <div class="xe-comment-entry">
                    <div class="xe-user-img">
                        <?php if(io_get_option('lazyload')): ?>
                        <img class="img-circle lazy" src="<?php echo $default_ico; ?>" data-src="<?php echo get_post_meta($post->ID, '_thumbnail', true)? get_post_meta($post->ID, '_thumbnail', true): (io_get_option('ico_url') .format_url($link_url) . io_get_option('ico_png')) ?>" onerror="javascript:this.src='<?php echo $default_ico; ?>'" width="40">
                        <?php else: ?>
                        <img class="img-circle lazy" src="<?php echo get_post_meta($post->ID, '_thumbnail', true)? get_post_meta($post->ID, '_thumbnail', true): (io_get_option('ico_url') .format_url($link_url) . io_get_option('ico_png')) ?>" onerror="javascript:this.src='<?php echo $default_ico; ?>'" width="40">
                        <?php endif ?>
                    </div>
                    <div class="xe-comment">
                        <div class="xe-user-name overflowClip_1">
                            <strong><?php the_title() ?></strong>
                        </div>
                        <p class="overflowClip_1"><?php echo get_post_meta($post->ID, '_sites_sescribe', true) ?: preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","",get_the_excerpt($post->ID)); ?></p>
                    </div>
                </div>
            </a>
            
