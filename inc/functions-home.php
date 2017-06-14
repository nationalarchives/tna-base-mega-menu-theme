<?php
/**
 * Homepage functions
 */

function hide_editor_from_homepage() {

	if ( is_homepage_template() ) {
		remove_meta_box( 'postexcerpt' , 'page' , 'normal' );
		remove_post_type_support('page', 'editor');
	}
}

function get_html_content( $url ) {

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST . ':' . WP_PROXY_PORT);
	curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$content = curl_exec($ch);

	curl_close($ch);

	return $content;
}

function get_content_and_display_card( $id, $url, $title, $image ) {

	$meta_og_img = trim($image);
	$meta_og_title = trim($title);

	$environment = identifyEnvironmentFromIP($_SERVER['SERVER_ADDR'], $_SERVER['REMOTE_ADDR']);

	if ( $url ) {
		if (strpos($url, 'eventbrite') !== false && $environment !== 'development') {
			$content_html = get_html_content($url);
		} elseif (strpos($url, 'bookshop.nationalarchives.gov.uk') !== false && $environment !== 'development') {
			$content_html = get_html_content($url);
		} else {
			$content_html = file_get_contents($url);
		}

		$html = new DOMDocument();
		@$html->loadHTML($content_html);

		$i = 1;

		foreach( $html->getElementsByTagName('meta') as $meta ) {

			if( $meta->getAttribute('property')=='og:title' && trim($title)=='' ) {
				$meta_og_title = $meta->getAttribute('content');
			}

			if( $meta->getAttribute('property')=='og:image' && trim($image)=='' ) {
				$meta_og_img[$i] = $meta->getAttribute('content');
				$i++;
			}
		}

		if ($meta_og_title == 'Page Not Found - The National Archives') {
			return card_fallback( 'Latest news', $id );
		} else {
			if (isset($meta_og_img[1]) == false) {
				$meta_og_img[1] = '';
			}
			return card_html( $id, $url, $meta_og_img[1], content_type( $url ), $meta_og_title );
		}
	}
}

function content_type( $url ) {
	if (strpos($url, 'nationalarchives.gov.uk/about/news/') !== false) {

		return 'News';
	}
	if (strpos($url, 'blog.nationalarchives.gov.uk') !== false) {

		return 'Blog';
	}
	if (strpos($url, 'media.nationalarchives.gov.uk') !== false) {

		return 'Multimedia';
	}
	if (strpos($url, 'eventbrite') !== false) {

		return 'Event';
	}

	return 'Feature';
}

function card_html_markup( $id, $url, $target, $image, $icon, $type, $title ) {

	$title = esc_attr($title);

	$html = '<div class="col-card">
				<div class="card">
					<a id="card-%s" href="%s" %s
						data-gtm-name="%s"
						data-gtm-id="card_%s"
						data-gtm-position="card_position_%s"
						data-gtm-creative="homepage_card_%s"
					class="homepage-card">
						<div class="entry-thumbnail" style="background-image: url(%s)">
						</div>
						<div class="entry-content">
							<div class="content-type %s">%s</div>
							<h3>%s</h3>
						</div>
					</a>
				</div>
			</div>';

	return sprintf( $html, $id, $url, $target, $title, $id, $id, $type, $image, $icon, $type, $title );
}

function card_html( $id, $url, $image, $type, $title ) {

	$target = '';
	$icon = '';
	if ($type=='Event') {
		$target = 'target="_blank"';
		$icon = 'event-icon';
	}
	if ($type=='Multimedia') {
		$icon = 'media-icon';
	}

	return card_html_markup( $id, $url, $target, $image, $icon, $type, $title );

}

function banner_html( $image, $type, $title, $excerpt, $url, $button ) {

	$title = esc_attr($title);
	$image = make_path_relative_no_pre_path($image);

	$html = '<div class="container">
		        <div class="row">
		            <div class="home-banner" style="background-image: url(%s);">
		                <div class="entry-wrapper">
		                    <div class="entry-content">
		                        <div class="content-type">%s</div>
		                        <h2>%s</h2>
		                        <p>%s</p>
		                        <div class="banner-call-to-action">
		                            <a id="hero-banner" href="%s"
			                            data-gtm-name="%s"
										data-gtm-id="hero_1"
										data-gtm-position="hero_position_banner"
										data-gtm-creative="homepage_hero_%s"
		                            class="ghost-button homepage-hero" aria-label="%s" role="button">%s</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>';

	return sprintf( $html, $image, $type, $title, $excerpt, $url, $title, $type, $title, $button );

}

function home_banner( $expire, $status, $image, $title, $excerpt, $url, $button ) {

	if ( $status == 'Enable' && is_card_active( $expire ) ) {
		return banner_html( $image, content_type( $url ), $title, $excerpt, $url, $button );
	}

}

function update_page_delete_transient(){
	for ( $i=1 ; $i<=6 ; $i++ ) {

		$transient = get_transient( 'homepage_cards_html'.$i );

		if( $transient  ) {
			delete_transient( 'homepage_cards_html'.$i );
		}
	}
}

function is_card_active( $expire ) {

	if ($expire) {
		$expire_date = strtotime($expire);
	} else {
		$expire_date = 9999999999;
	}

	$current_date = strtotime('today');

	if ( $current_date <= $expire_date ) {
		return true;
	} else {
		return false;
	}
}

function card_fallback( $fallback, $id ) {

	$url = 'http://www.nationalarchives.gov.uk/about/visit-us/whats-on/events/';
	$image = get_stylesheet_directory_uri().'/img/events.jpg';
	$image = make_path_relative_no_pre_path($image);
	$type = 'Events';
	$title = 'Upcoming events and exhibitions at The National Archives';
	$target = '';
	$icon = 'event-icon';

	if ( $fallback == 'Latest news' ) {

		$rss = file_get_contents( 'http://www.nationalarchives.gov.uk/category/news/feed/' );

		$content = new SimpleXmlElement( $rss );

		$url = str_replace('livelb', 'www', $content->channel->item[0]->link);
		$image = str_replace('livelb', 'www', $content->channel->item[0]->enclosure['url']);
		$type = 'News';
		$title = $content->channel->item[0]->title;
		$icon = '';

	}
	if ( $fallback == 'Latest blog post' ) {

		$rss = file_get_contents( 'http://blog.nationalarchives.gov.uk/feed/' );

		$content = new SimpleXmlElement( $rss );

		$url = str_replace('livelb', 'www', $content->channel->item[0]->link);
		$image = str_replace('livelb', 'www', $content->channel->item[0]->enclosure['url']);
		$type = 'Blog';
		$title = $content->channel->item[0]->title;
		$icon = '';

	}

	return card_html_markup( $id, $url, $target, $image, $icon, $type, $title );
}

function check_cards() {

	if( is_homepage_template() && isset($_POST['home_card_url_1']) ) {

		$stack = array();

		for ( $i = 1; $i <= 6; $i ++ ) {

			$url = $_POST[ 'home_card_url_' . $i ];

			$expire = $_POST[ 'home_card_expire_' . $i ];
			$fallback = $_POST[ 'home_card_fallback_' . $i ];

			if ( $url ) {
				array_push( $stack, $url );
			}

			if ( $expire && $fallback == 'Select fallback content' ) {
				set_transient( get_current_user_id() . 'cards_error_fallback', 'error' );
			}
		}

		$result = count( $stack );

		if ( $result == 3 || $result == 6 ) {
			// do nothing
		} else {
			set_transient( get_current_user_id() . 'cards_error', $result );
		}
	}
}

function cards_admin_notice() {
	$cards_error = get_transient( get_current_user_id().'cards_error' );
	if ($cards_error) { ?>
		<div class="notice notice-error card-error">
			<p><?php _e( 'You haven\'t edited the fields correctly. Please enter content for either 3 or 6 cards.', 'cards-error' ); ?></p>
		</div>
	<?php
		delete_transient( get_current_user_id().'cards_error' );
	}
	$cards_error_fallback = get_transient( get_current_user_id().'cards_error_fallback' );
	if ($cards_error_fallback) { ?>
		<div class="notice notice-error card-error">
			<p><?php _e( 'You have select a card to expire without a fallback. Please select a fallback option.', 'cards-error' ); ?></p>
		</div>
		<?php
		delete_transient( get_current_user_id().'cards_error_fallback' );
	}
}

function is_homepage_template() {
	if (isset($_GET['post'])) {
		$post_id = $_GET['post'];
	} else {
		if (isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		} else {
			$post_id = '';
		}
	}
	if( !isset( $post_id ) ) return;

	$template_file = get_post_meta($post_id, '_wp_page_template', true);

	if( $template_file == 'page-home.php' ) {
		return true;
	} else {
		return false;
	}
}

function landingpage_link_html_markup( $title, $url, $text ) {

	$html = '<div class="col-md-3 col-sm-6 col-link-card">
                    <div class="link-card">
                        <a href="%s">
                            <div class="entry-head">
                                <h3>%s</h3>
                            </div>
                            <div class="entry-content">
                                <p>%s</p>
                            </div>
                        </a>
                    </div>
                </div>';

	return sprintf( $html, $url, $title, $text );

}

