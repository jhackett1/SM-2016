<?php

//Initial addition of responsive styling and jQuery
	wp_enqueue_style( 'Styles', get_stylesheet_uri() );
	wp_enqueue_style( 'FontAwesome', get_stylesheet_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.12.4.min.js');
	wp_enqueue_script( 'masthead', get_template_directory_uri() . '/js/masthead.js');
	wp_enqueue_script( 'masonry', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js');

//Adds in Google Web fonts
	function load_fonts() {
		wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Oswald:400,700,300|Lato:400,300,400italic,700');
		wp_enqueue_style( 'googleFonts');
		}
		add_action('wp_print_styles', 'load_fonts');

//Hide visual editor for everyone
add_filter('user_can_richedit' , create_function('' , 'return false;') , 50);

//Menu registration
	 register_nav_menus(array(
	   'top' => __('Smoke Media Menu'),
		 'primary' => __('Sections Menu'),
		 'social' => __('Social Menu'),
	   'footer' => __('Footer Menu'),
	 ));

//Allows featured images
	 add_theme_support( 'post-thumbnails' );

//New default avatar

	function newgravatar ($avatar_defaults) {
    $myavatar = get_bloginfo('template_directory') . '/img/swirl.png';
    $avatar_defaults[$myavatar] = "Build Internet";
    return $avatar_defaults;
}

//Change admin theme for new users

	function set_default_admin_color($user_id) {
	$args = array(
		'ID' => $user_id,
		'admin_color' => 'midnight'
	);
	wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');

if ( !current_user_can('manage_options') )
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

//Reduce excerpt length
			 function custom_excerpt_length( $length ) {
			return 15;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 15 );

//Custom read more
	function new_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

//Reading time

function reading_time(){
	$content = get_post_field( 'post_content', $post->ID );
	$word_count = str_word_count( strip_tags( $content ) );
	$minutes_raw = ($word_count / 200);
	$minutes_rounded = ceil($minutes_raw);
	echo $minutes_rounded . " minute read";
}

//Set up sidebar and other widgetised areas

function sidebar() {

	register_sidebar( array(
		'name'          => 'Posts sidebar',
		'id'            => 'sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'sidebar' );


//Set custom widgets

	class latest_issue extends WP_Widget {
		function __construct(){
			parent::__construct(false, $name =  __('Smoke Latest Issue'));
		}
		function form( $instance ){
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" ></input>
			</p><p>
				<label for="<?php echo $this->get_field_id('cat'); ?>">Source category number (default is 31):</label>
				<input id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" value="<?php echo esc_attr($instance['cat']); ?>" ></input>
			</p>
			<?php
		}

		function widget($args, $instance){

			extract ( $args, EXTR_SKIP);
			$title = ( $instance['title']) ? $instance['title'] : '';
			$category = ( $instance['title']) ? $instance['cat'] : '31';

			echo '<div class="widget">' ;
			echo '<h4>' . $title . '</h4>' ;

			$query = new WP_Query( array( 'cat' => $category, 'posts_per_page' => 1 ) );
			// The Loop
			while ( $query->have_posts() ) {
				$query->the_post();
				$feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
				$feat = $feat[0];
				?>
				<a class="latest-cover" href="<?php the_permalink(); ?>">
		      <img id="latest-cover" src="<?php echo $feat; ?>"/>
				</a>
				<?php
			}
			wp_reset_postdata();
			echo '</div>' ;
		}
	}

add_action('widgets_init', function(){
	register_widget('latest_issue');
});

class smoke_related_posts extends WP_Widget {
	function __construct(){
		parent::__construct(false, $name =  __('Smoke Related Posts'));
	}
	function form(){

	}
	function update(){

	}
	function widget($args, $instance){ ?>
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
		<?php
	}
}

add_action('widgets_init', function(){
register_widget('smoke_related_posts');
});


class smoke_subscribe extends WP_Widget {
	function __construct(){
		parent::__construct(false, $name =  __('Smoke Subscribe'));
	}
	function form(){
	}
	function update(){
	}
	function widget($args, $instance){
		echo '<div class="widget red mobilehide">' ;
		echo '<h4>Get involved</h4>' ;
		?>
		<p>Want to contribute? Get on our mailing list.</p>
		<!-- Begin MailChimp Signup Form -->
		<link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
		<div id="mc_embed_signup">
		<form action="//media.us13.list-manage.com/subscribe/post?u=bae3fdf7dc6f735f144847240&amp;id=ffaab9e48d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		    <div id="mc_embed_signup_scroll">

			<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required>
		    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
		    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bae3fdf7dc6f735f144847240_ffaab9e48d" tabindex="-1" value=""></div>
		    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
		    </div>
		</form>
		</div>

		<!--End mc_embed_signup-->
		<?php
		echo '</div>' ;
	}
}
add_action('widgets_init', function(){
register_widget('smoke_subscribe');
});




class smoke_twitter_feed extends WP_Widget {
	function __construct(){
		parent::__construct(false, $name =  __('Smoke Twitter Feed'));
	}
	function form(){

	}
	function update(){

	}
	function widget($args, $instance){
		echo '<div class="widget mobilehide">' ;
		echo '<h4>Tweets</h4>' ;
		?>
			<a class="twitter-timeline" data-chrome="transparent noheader nofooter" data-height="500" href="https://twitter.com/dinosaurlord/lists/smoke">A Twitter List by dinosaurlord</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		<?php
		echo '</div>' ;
	}
}
add_action('widgets_init', function(){
register_widget('smoke_twitter_feed');
});


//Responsive youtube embeds

add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}



//Allow image logo

function themeslug_theme_customizer( $wp_customize ) {
	$wp_customize->add_section( 'themeslug_logo_section' , array(
		'title'       => __( 'Logo', 'themeslug' ),
		'priority'    => 30,
		'description' => 'Upload a logo to replace the default site name and description in the header',
	) );

	$wp_customize->add_setting( 'themeslug_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
	    'label'    => __( 'Logo', 'themeslug' ),
	    'section'  => 'themeslug_logo_section',
	    'settings' => 'themeslug_logo',
	) ) );
}
add_action( 'customize_register', 'themeslug_theme_customizer' );



add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<table class="form-table">

		<tr>
			<th><label for="twitter">Twitter</label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Twitter username, without the @ symbol.</span>
			</td>
		</tr>
		<tr>
			<th><label for="mail">Public email:</label></th>

			<td>
				<input type="text" name="mail" id="mail" value="<?php echo esc_attr( get_the_author_meta( 'mail', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Smoke Media email, if you wish it to be publicly visible. This does NOT need to be the same as the email your account is registered to.</span>
			</td>
		</tr>
	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'mail', $_POST['mail'] );
}
