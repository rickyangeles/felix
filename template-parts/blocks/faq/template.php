<?php
    //Content
    $questions_answers      = get_field('questions_answers');
    $addition_content       = get_field('additional_content');
    //Styles
    $bg_color               = get_field('background_color');
    $h_padding              = get_field('horizontal_padding');
    $main_content_width     = get_field('main_content_width');
    $main_content_side      = get_field('main_content_side') == 'right' ? 'flex-row-reverse': '';
    $schema                 = get_field('enable_faq_schema');
    $c_count                = 0;
    $q_count                = count($questions_answers);

    if ( $addition_content ) {
        if ( $main_content_width == 'col-md-9') {
            $addition_content_width = 'col-md-3';
        } elseif ( $main_content_width == 'col-md-6' ) {
            $addition_content_width = 'col-md-6';
        } elseif ( $main_content_width == 'col-md-3') {
            $addition_content_width = 'col-md-9';
        }
    } else {
        $main_content_width = 'col-12';
    }
    $id                     = 'faq-' . $block['id'];
?>

<section class="block faq container-fluid <?php echo $bg_color . ' ' . $h_padding; ?>">
    <?php block_custom_id(); ?>
    <div class="container">
        <?php echo get_block_header(); ?>
        <div class="row d-flex <?php echo $main_content_side; ?>">
            <div class="accordion <?php echo $main_content_width; ?>" id="<?php echo 'faq-' . $block['id']; ?>">
                <?php if ( have_rows('questions_answers') ) : ?>
                    <?php $count = 0; while( have_rows('questions_answers') ): the_row(); ?>
                        <?php
                            $q = get_sub_field('question');
                            $a = get_sub_field('answer');
                        ?>
                        <?php if ( $q || $a ) : ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo $count;?>">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $count;?>" aria-expanded="true" aria-controls="collapse<?php echo $count;?>">
                                    <?php echo $q; ?>
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapse<?php echo $count;?>" class="collapse" aria-labelledby="heading<?php echo $count;?>" data-parent="#<?php echo 'faq-' . $block['id']; ?>">
                                    <div class="card-body"><?php echo $a; ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php $c_count++; $count++; endwhile; ?>
                <?php endif; ?>
            </div>
            <?php if ( $addition_content ) : ?>
                <div class="<?php echo $addition_content_width; ?>">
                    <?php echo $addition_content; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php echo get_block_button(); ?>
    </div>
    <script type="text/javascript">
    (function($){

        var initializeBlock = function( $block ) {
            $('#<?php echo 'faq-' . $block['id']; ?>').collapse();
        }

        // Initialize each block on page load (front end).
        $(document).ready(function(){
          initializeBlock();
        });

        // Initialize dynamic block preview (editor).
        if( window.acf ) {
            window.acf.addAction( 'render_block_preview', initializeBlock );
        }

    })(jQuery);
    </script>

    <?php if ( $schema && have_rows('questions_answers') ) : ?>
        <?php $c_count = 0; ?>

        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [<?php while( have_rows('questions_answers') ): the_row(); $c_count++; $q = get_sub_field('question'); $q = str_replace('"', "'", $q); $a = get_sub_field('answer'); $a = str_replace('"', "'", $a);  ?>{
                "@type": "Question",
                "name": "<?php echo $q; ?>",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "<?php echo $a; ?>"
              }
          }<?php if ( $c_count < $q_count ) { echo ','; } ?><?php endwhile; ?>]
            }
        </script>

    <?php endif; ?>
</section>
