<?php

//Contact Information Widget
class Contact_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'contact_info',  // Base ID
            'Contact Information'   // Name
        );

        add_action( 'widgets_init', function() {
            register_widget( 'Contact_Widget' );
        });

    }

    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );

    public function widget( $args, $instance ) {
        $phone = get_field('phone_number', 'options');
        $free = get_field('toll_free_number', 'options');
        $fax = get_field('fax_number', 'options');
        $email = get_field('email_address', 'options');
        $street = get_field('street_address', 'options');
        $city = get_field('city', 'options');
        $state = get_field('state', 'options');
        $zip = get_field('zip_code', 'options');
        $direction = get_field('direction_link', 'options');

        $widget_id = 'footer_right';
        $show_address = get_field('show_street_address', 'widget_' . $args['widget_id']);
        $show_phone = get_field('show_phone_number', 'widget_' . $args['widget_id']);
        $show_free = get_field('show_toll_free_number', 'widget_' . $args['widget_id']);
        $show_email = get_field('show_email_address', 'widget_' . $args['widget_id']);
        $show_direction = get_field('show_direction_link', 'widget_'. $args['widget_id']);
        $show_labels = get_field('show_labels', 'widget_' . $args['widget_id']);

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        echo '<div class="textwidget">';
        if ( $show_address || $show_phone || $show_free || $show_email ) {
            echo '<ul class="widget-contact-info">';
            //Address
            if ( $show_address ) {
                if ( $show_labels ) {
                    echo '<li class="street-address"><strong>Address</strong><br>' . $street . ',<br> ' . $city . ', ' . $state . ' ' . $zip . '</li>';
                } else {
                    echo '<li class="street-address">' . $street . ',<br> ' . $city . ', ' . $state . ' ' . $zip . '</li>';
                }
            }
            if ( $show_direction ) {
                echo '<li class="direction-link"><a href="' . $direction . '">' . '(Directions)</a></li>';
            }
            //Phone
            if ( $show_phone ) {
                if ( $show_labels ) {
                    echo '<li class="phone"><strong>Phone: </strong><a href="tel:' . $phone . '">' . $phone . '</a>';
                } else {
                    echo '<li class="phone"><a href="tel:' . $phone . '">' . $phone . '</a>';
                }
            }
            //Toll Free
            if ( $show_free ) {
                if ( $show_labels ) {
                    echo '<li class="toll-free"><strong>Toll-Free: </strong><a href="tel:' . $free . '">' . $free . '</a>';
                } else {
                    echo '<li class="toll-free"><a href="tel:' . $free . '">' . $free . '</a>';
                }
            }
            //Email
            if ( $show_email ) {
                if ( $show_labels ) {
                    echo '<li class="email"><strong>Email: </strong><a href="mailto:' . $email . '">' . $email . '</a>';
                } else {
                    echo '<li class="email"><a href="mailto:' . $email . '">' . $email . '</a>';
                }
            }
            echo '</ul>';
        }

        echo '</div>';

        echo $args['after_widget'];

    }

    public function form( $instance ) {

        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( '', 'text_domain' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php

    }

    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';

        return $instance;
    }

}
$contact_widget = new Contact_Widget();


//Social Icon Widget
class Social_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'social_icons',  // Base ID
            'Social Icons'   // Name
        );

        add_action( 'widgets_init', function() {
            register_widget( 'Social_Widget' );
        });

    }

    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );

    public function widget( $args, $instance ) {
        $theme = get_field('theme', 'widget_' . $args['widget_id']);

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        echo '<div class="textwidget">';
        $socialList = array('facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'youtube', 'tripadvisor', 'yelp');
        echo '<ul class="widget-social-icon ' . $theme . '">';
        foreach ( $socialList as $social ) {
            $s_name = $social . '_url';
            $s_field = get_field($s_name, 'options');
            if ( $s_field && $social == 'facebook') {
                echo '<li><a href="' . $s_field . '" target="_blank"><i class="fab fa-' . $social . '-f"></i></a></li>';
            } elseif ( $s_field && $social == 'linkedin') {
                echo '<li><a href="' . $s_field . '" target="_blank"><i class="fab fa-' . $social . '-in"></i></a></li>';
            } elseif ( $s_field && $social == 'pinterest') {
                echo '<li><a href="' . $s_field . '" target="_blank"><i class="fab fa-' . $social . '-p"></i></a></li>';
            } elseif ( $s_field ) {
                echo '<li><a href="' . $s_field . '" target="_blank"><i class="fab fa-' . $social . '"></i></a></li>';
            }
        }
        echo '</ul>';

        echo '</div>';

        echo $args['after_widget'];

    }

    public function form( $instance ) {

        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( '', 'text_domain' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <!-- <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'Text' ) ); ?>"><?php echo esc_html__( 'Text:', 'text_domain' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo esc_attr( $text ); ?></textarea>
        </p> -->
        <?php

    }

    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';

        return $instance;
    }

}
$social_widget = new Social_Widget();

//Social Icon Widget
class FooterCTA_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'footer_cta_widget',  // Base ID
            'Footer CTA Widget'   // Name
        );

        add_action( 'widgets_init', function() {
            register_widget( 'FooterCTA_Widget' );
        });

    }

    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        echo '<div class="textwidget">';

        $footerCTA = get_field('override_footer_cta', $pID) ? get_field('override_footer_cta', $pID) : get_field('footer_cta', 'options');
        if ( $footerCTA ) {
            echo '<a href="' . $footerCTA['url'] . '" class="button white cta">' . $footerCTA['title'] . '</a>';
        }
        echo '</div>';

        echo $args['after_widget'];
    }

    public function form( $instance ) {

        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( '', 'text_domain' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php

    }
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';

        return $instance;
    }
}
$footer_cta_widget = new FooterCTA_Widget();
