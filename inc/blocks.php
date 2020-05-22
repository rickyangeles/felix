<?php
    wp_enqueue_style( 'block-css', get_template_directory_uri() . '/css/_blocks.css', array(), '', false);

    function my_mario_block_category( $categories, $post ) {
    	return array_merge(
    		$categories,
    		array(
    			array(
    				'slug' => 'i-g-blocks',
    				'title' => __( 'Improve & Grow Blocks', 'i-g-blocks' ),
    			),
    		)
    	);
    }
    add_filter( 'block_categories', 'my_mario_block_category', 10, 2);

    add_action('acf/init', 'register_full_width_block');
    function register_full_width_block() {
        //Full Width
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'full-width',
                'title' => __('Full Width'),
                'description' => __('Starter Full Width'),
                'render_template' => '/template-parts/blocks/full-width/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('full-width-styles', get_template_directory_uri() . '/template-parts/blocks/full-width/full-width.css');
                },
                'category' => 'i-g-blocks',
                'icon' => 'text',
                'keywords' => array('starter', 'full-width'),
            ));
        }

        //FAQs
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'faq',
                'title' => __('FAQs'),
                'description' => __('Starter FAQs'),
                'render_template' => '/template-parts/blocks/faq/template.php',
                'enqueue_assets'   => function() {
                    wp_enqueue_script( 'bootstrap-editor-js', get_template_directory_uri() . '/js/bootstrap.min.js');
                    wp_enqueue_style( 'faq-styles', get_template_directory_uri() . '/template-parts/blocks/faq/faq.css');
                },
                'category' => 'i-g-blocks',
                'icon' => 'format-chat',
                'keywords' => array('starter', 'faq'),
            ));
        }

        //Slider
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'slider',
                'title' => __('Slider'),
                'description' => __('Starter Slider'),
                'render_template' => '/template-parts/blocks/slider/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('slider-style', get_template_directory_uri() . '/template-parts/blocks/slider/slider.css');
                    wp_enqueue_style('splide-core', get_template_directory_uri() . '/css/splide/splide.min.css');
                    wp_enqueue_style('splide-theme', get_template_directory_uri() . '/css/splide/splide-default.min.css');
                    wp_enqueue_script('splide-js', get_template_directory_uri() . '/js/splide/splide.min.js');
                },
                'category' => 'i-g-blocks',
                'icon' => 'slides',
                'keywords' => array('starter', 'slider'),
            ));
        }

        //Multi Column
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'multi-column',
                'title' => __('Multi Column'),
                'description' => __('Starter Multi Column'),
                'render_template' => '/template-parts/blocks/multi-column/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('multi-column-styles', get_template_directory_uri() . '/template-parts/blocks/multi-column/multi-column.css');
                },
                'category' => 'i-g-blocks',
                'icon' => 'screenoptions',
                'keywords' => array('starter', 'multi-column'),
            ));
        }

        //Split Column
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'split',
                'title' => __('Split Column'),
                'description' => __('Starter Split Column'),
                'render_template' => '/template-parts/blocks/split/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('split-column-styles', get_template_directory_uri() . '/template-parts/blocks/split/split.css');
                },
                'category' => 'i-g-blocks',
                'icon' => 'image-flip-horizontal',
                'keywords' => array('starter', 'split columns'),
            ));
        }

        //CTA
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'cta',
                'title' => __('CTA'),
                'description' => __('Starter CTA'),
                'render_template' => '/template-parts/blocks/cta/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('cta-styles', get_template_directory_uri() . '/template-parts/blocks/cta/cta.css');
                },
                'category' => 'i-g-blocks',
                'icon' => 'megaphone',
                'keywords' => array('starter', 'cta'),
            ));
        }

        //Post Picker
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'post',
                'title' => __('Post Picker'),
                'description' => __('Starter Post Picker'),
                'render_template' => '/template-parts/blocks/post/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('post-styles', get_template_directory_uri() . '/template-parts/blocks/post/post.css');
                },
                'category' => 'i-g-blocks',
                'icon' => 'format-aside',
                'keywords' => array('starter', 'posts'),
            ));
        }

        //Testimonials
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'testimonial',
                'title' => __('Testimonial'),
                'description' => __('Starter Testimonials'),
                'render_template' => '/template-parts/blocks/testimonial/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('testimonial-style', get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css');
                    wp_enqueue_style('splide-core', get_template_directory_uri() . '/css/splide/splide.min.css');
                    wp_enqueue_style('splide-theme', get_template_directory_uri() . '/css/splide/splide-default.min.css');
                    wp_enqueue_script('splide-js', get_template_directory_uri() . '/js/splide/splide.min.js');
                },
                'category' => 'i-g-blocks',
                'icon' => 'format-quote',
                'keywords' => array('starter', 'testimonial'),
            ));
        }

        //Steps
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'steps',
                'title' => __('Steps'),
                'description' => __('Starter Steps'),
                'render_template' => '/template-parts/blocks/steps/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('steps-style', get_template_directory_uri() . '/template-parts/blocks/steps/steps.css');
                },
                'category' => 'i-g-blocks',
                'icon' => 'chart-bar',
                'keywords' => array('starter', 'steps'),
            ));
        }

        //Carousel
        if(function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name' => 'carousel',
                'title' => __('Carousel'),
                'description' => __('Starter Carousel'),
                'render_template' => '/template-parts/blocks/carousel/template.php',
                'enqueue_assets'	=> function(){
                    wp_enqueue_style('carousel-style', get_template_directory_uri() . '/template-parts/blocks/carousel/carousel.css');
                    wp_enqueue_style('splide-core', get_template_directory_uri() . '/css/splide/splide.min.css');
                    wp_enqueue_style('splide-theme', get_template_directory_uri() . '/css/splide/splide-default.min.css');
                    wp_enqueue_script('splide-js', get_template_directory_uri() . '/js/splide/splide.min.js');
                },
                'category' => 'i-g-blocks',
                'icon' => 'images-alt2',
                'keywords' => array('starter', 'carousel'),
            ));
        }

    }
?>
