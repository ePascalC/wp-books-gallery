<?php get_header(); ?>

<div class="wbg-details-wrapper">

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

    <div class="wbg-details-image">
        <?php
        if ( has_post_thumbnail() ) {
            the_post_thumbnail();
        }
        else { ?>
        <img src="img_snow.jpg" alt="Snow" style="width:100%">
        <?php 
        } ?>
    </div>
    <div class="wbg-details-description">
        <h5 class="wbg-details-book-title"><?php the_title(); ?></h5>
        <span>
            <b>Author:</b>
            <?php
            $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
            if ( !empty( $wbgAuthor ) ){
                echo $wbgAuthor;
            }
            ?>
        </span>
        <span>
            <b>Category:</b>
            <?php
            $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array( 'fields' => 'all' ) );
            echo $wbgCategory[0]->name;
            ?>
        </span>
        <span>
            <b>Publisher:</b>
            <?php
            $wbgPublisher = get_post_meta( $post->ID, 'wbg_publisher', true );
            if ( !empty( $wbgPublisher ) ){
                echo $wbgPublisher;
            }
            ?>
        </span>
        <span>
            <b>Publish:</b>
            <?php
            $wbgPublished = get_post_meta( $post->ID, 'wbg_published_on', true );
            if ( !empty( $wbgPublished ) ){
                echo date('d M, Y', strtotime($wbgPublished));
            }
            ?>
        </span>
        <span>
            <b>ISBN:</b>
            <?php
            $wbgIsbn = get_post_meta( $post->ID, 'wbg_isbn', true );
            if ( !empty( $wbgIsbn ) ){
                echo $wbgIsbn;
            }
            ?>
        </span>
        <span>
            <b>Pages:</b>
            <?php
            $wbgPages = get_post_meta( $post->ID, 'wbg_pages', true );
            if ( !empty( $wbgPages ) ){
                echo $wbgPages . ' Pages';
            }
            ?>
        </span>
        <span>
            <b>Country:</b>
            <?php
            $wbgCountry = get_post_meta( $post->ID, 'wbg_country', true );
            if ( !empty( $wbgCountry ) ){
                echo $wbgCountry;
            }
            ?>
        </span>
        <span>
            <b>Language:</b>
            <?php
            $wbgLanguage = get_post_meta( $post->ID, 'wbg_language', true );
            if ( !empty( $wbgLanguage ) ){
                echo $wbgLanguage;
            }
            ?>
        </span>
        <span>
            <b>Dimension:</b>
            <?php
            $wbgDimension = get_post_meta( $post->ID, 'wbg_dimension', true );
            if ( !empty( $wbgDimension ) ){
                echo $wbgDimension;
            }
            ?>
        </span>
        <span>
            <b>File Size:</b>
            <?php
            $wbgFilesize = get_post_meta( $post->ID, 'wbg_filesize', true );
            if ( !empty( $wbgFilesize ) ){
                echo $wbgFilesize;
            }
            ?>
        </span>
        <?php
        $wbgLink = get_post_meta( $post->ID, 'wbg_download_link', true );
        if ( !empty( $wbgLink ) ){
            $wbgLink2 = $wbgLink;
        } else{
            $wbgLink2 = "#";
        }
        ?>
        <span>
            <b>Url:</b>
            <a href="<?php echo esc_url($wbgLink2); ?>" class="wgb-details-link" target="blank">Buy Now / Download</a>
        </span>
    </div>
    <div class="wbg-details-description-full">
        <div class="wbg-details-description-title">
            <b>Description:</b>
            <hr>
        </div>
        <div class="wbg-details-description-content">
            <?php the_content(); ?>
        </div>
    </div>
<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>