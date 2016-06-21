<div class="widget posts-widget">

    <ul class="tabs">
      <li class="tab-link current" data-tab="tab-1">Related</li>
      <li class="tab-link" data-tab="tab-2">Recent</li>
    </ul>


    <div id="tab-1" class="tab-content current">
      <ul class="widget-posts-list">

      <?php
      // Related posts query
      $orig_post = $post;
      global $post;
      $categories = get_the_category($post->ID);

      if ($categories) {
      $category_ids = array();
      foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

      $args = array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=> 4, // Number of related posts that will be displayed.
        'caller_get_posts'=>1,
        'orderby'=>'post_date' // Randomize the posts
      );

      $related_query = new WP_Query( $args );
      if ( $related_query->have_posts() ):
          while ( $related_query->have_posts() ): $related_query->the_post();
       $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small' );
      $feat = $feat[0];
          ?>
            <li>
                <img src="<?php echo $feat; ?>"/>
                <div>
                  <h5><?php the_title(); ?></h5>
                  <p><?php the_date(); ?></p>
                </div>
                <a href="<?php the_permalink(); ?>"></a>
            </li>
          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif;  }; ?>

      </ul>
    </div>
    <div id="tab-2" class="tab-content">
      <ul class="widget-posts-list">

        <?php
        // Recent posts query
        $the_query = new WP_Query( array( 'posts_per_page' => 4 ) );
        if ( $the_query->have_posts() ):
            while ( $the_query->have_posts() ): $the_query->the_post();                              $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small' );
            $feat = $feat[0];
          ?>
            <li>
                <img src="<?php echo $feat; ?>"/>
                <div>
                  <h5><?php the_title(); ?></h5>
                  <p><?php the_date(); ?></p>
                </div>
                <a href="<?php the_permalink(); ?>"></a>
            </li>
          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <p><?php _e( '<p style="margin: 10px; margin-top: 20px">Sorry, no posts matched your criteria.</p>' ); ?></p>
        <?php endif; ?>

      </ul>
    </div>






</div>
