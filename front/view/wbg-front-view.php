<?php
$category =  isset($attr['category']) ? $attr['category'] : '';
$display = isset($attr['display']) ? $attr['display'] : '';
$pagination = isset($attr['pagination']) ? $attr['pagination'] : false;
$wbgPaged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$wbgBooksArr = array(
                      'post_type' => 'books',
                      'post_status' => 'publish',
                      'order' => 'DESC',
                      'meta_query' => array(
                                              array(
                                                  'key' => 'wbg_status',
                                                  'value' => 'active',
                                                  'compare' => 'LIKE'
                                              )
                                              ),
                    );
if($display!=''){
  $wbgBooksArr['posts_per_page'] = $display;
}
if($category!=''){
  $wbgBooksArr['tax_query'] = array(
                                      array(
                                              'taxonomy' => 'book_category',
                                              'field' => 'name',
                                              'terms' => $category
                                          )
                                      );
}
if($pagination=='true'){
  $wbgBooksArr['paged'] = $wbgPaged;
}
wp_reset_query();
$wbgBooks = new WP_Query($wbgBooksArr);
?>
<div class="wbg-main-wrapper w3-row-padding w3-padding-16 w3-center">
  <?php while($wbgBooks->have_posts()) : $wbgBooks->the_post(); global $post; ?>
  <div class="wgb-item w3-quarter">
    <?php
    if ( has_post_thumbnail() ) {
        the_post_thumbnail();
    }
    else { ?>
      <img src="img_snow.jpg" alt="Snow" style="width:100%">
    <?php 
    } 
    $wbgLink = get_post_meta( $post->ID, 'wbg_download_link', true );
    if ( !empty( $wbgLink ) ){
      $wbgLink2 = $wbgLink;
    } else{
      $wbgLink2 = "#";
    }
    ?>
    <a href="<?php echo get_the_permalink($post->ID); ?>" target="blank">
        <?php 
          $wbgTitleLen = strlen(get_the_title());
          if($wbgTitleLen > 50){
            echo substr(get_the_title(), 0, 50) . '...';
          } else{
            the_title();
          }
        ?>
    </a>
    <span>
      Category:
      <?php
      $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array( 'fields' => 'all' ) );
      echo $wbgCategory[0]->name;
      ?>
    </span>
    <span>
      By:
      <?php
      $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
      if ( !empty( $wbgAuthor ) ){
          echo $wbgAuthor;
      }
      ?>
    </span>
  </div>
  <?php endwhile; ?>
</div>
<?php if($pagination=='true'){ ?>
<div style="width:100%; text-align:center;">
      <?php
      $wbgTotalPages = $wbgBooks->max_num_pages;

      if ($wbgTotalPages > 1){
  
          $wbgCurrentPage = max(1, get_query_var('paged'));
  
          echo paginate_links(array(
              'base'      => get_pagenum_link(1) . '%_%',
              'format'    => '/page/%#%',
              'current'   => $wbgCurrentPage,
              'total'     => $wbgTotalPages,
              'prev_text' => __('« prev'),
              'next_text' => __('next »'),
          ));
      }
      wp_reset_postdata();
      ?>
</div>
<?php } ?>