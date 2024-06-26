<?php
/*
 * @Theme Name:WebStack
 * @Theme URI:https://56world.pp.ua
 * @Author: Midou
 * @Author URI: https://56world.pp.ua
 * @Date: 2019-02-22 21:26:02
 * @LastEditors: Midou
 * @LastEditTime: 2021-08-22 23:05:46
 * @FilePath: \WebStack\templates\friendlink.php
 * @Description: 
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

        <?php if( io_get_option('links') ) : ?>
        <h4 class="text-gray mb-4">
            <i class="fa fa-bookmark" id="friendlink" style="margin-right:10px"></i><?php _e('友情链接','i_theme') ?>
        </h4>
        <div class="friendlink" style="margin-bottom:-40px">
            <div class="panel">
                <?php wp_list_bookmarks('title_li=&before=&after=&categorize=0&show_images=0&orderby=rating&order=DESC&category='.get_option('link_f_cat')); ?>
            </div> 
        </div> 
        <?php endif; ?> 
