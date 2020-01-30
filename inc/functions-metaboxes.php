<?php
/**
 * Hompage meta boxes
 */

function home_meta_boxes() {

	$descUrl = 'Enter the URL from the page you want to link to. This will automatically pull in the title and image (press preview to view).';
	$descExpire = 'If expire date and time set the card will expire at this specified time and fallback content will be displayed. Date format yyyy-mm-ddThh:mm.';
	$descExpireBanner = 'If expire date and time set the card will expire at this specified time. Date format yyyy-mm-ddThh:mm.';
	$descFallback = 'This feature is only in use if an expire date/time is selected. ‘What’s On’ is a static card. ‘Latest news/blog’ will display the most recently published content.';
	$descCardTitle = 'Only enter substitute text here when you need to override the automated title.';
	$descCardImage = 'If you need to override the automated image, paste the image URL here after uploading it to the image library. Image size 768px x 576px.';
	$descBannerImage = 'Add or paste image URL from media library. Image size 860px x 260px (~3.3:1 aspect ratio).';

	$home_meta_boxes = array(
		array(
			'id' => 'home_banner',
			'title' => 'Homepage hero banner',
			'pages' => 'page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Banner',
					'desc' => '',
					'id' => 'home_banner_status',
					'type' => 'select',
					'options' => array('Disable', 'Enable')
				),
				array(
					'name' => 'URL',
					'desc' => '',
					'id' => 'home_banner_url',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Title',
					'desc' => '',
					'id' => 'home_banner_title',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Excerpt',
					'desc' => '',
					'id' => 'home_banner_excerpt',
					'type' => 'textarea',
					'std' => ''
				),
				array(
					'name' => 'Image',
					'desc' => $descBannerImage,
					'id' => 'home_banner_img',
					'type' => 'media',
					'std' => ''
				),
				array(
					'name' => 'Event date/time',
					'desc' => '',
					'id' => 'home_banner_date',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Expire date/time',
					'desc' => $descExpireBanner,
					'id' => 'home_banner_expire',
					'type' => 'datetime',
					'std' => ''
				)
			)
		),
		array(
			'id' => 'home_card_1',
			'title' => 'Homepage card 1 - top left position',
			'pages' => 'page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Content URL*',
					'desc' => $descUrl,
					'id' => 'home_card_url_1',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Title',
					'desc' => $descCardTitle,
					'id' => 'home_card_title_1',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Excerpt',
					'desc' => '',
					'id' => 'home_card_excerpt_1',
					'type' => 'textarea',
					'std' => ''
				),
				array(
					'name' => 'Image',
					'desc' => $descCardImage,
					'id' => 'home_card_img_1',
					'type' => 'media',
					'std' => ''
				),
				array(
					'name' => 'Event date/time',
					'desc' => '',
					'id' => 'home_card_date_1',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Expire date/time',
					'desc' => $descExpire,
					'id' => 'home_card_expire_1',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Fallback',
					'desc' => $descFallback,
					'id' => 'home_card_fallback_1',
					'type' => 'select',
					'options' => array('What’s on', 'Latest news', 'Latest blog post')
				)
			)
		),
		array(
			'id' => 'home_card_2',
			'title' => 'Homepage card 2 - top middle position',
			'pages' => 'page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Content URL*',
					'desc' => $descUrl,
					'id' => 'home_card_url_2',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Title',
					'desc' => $descCardTitle,
					'id' => 'home_card_title_2',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Excerpt',
					'desc' => '',
					'id' => 'home_card_excerpt_2',
					'type' => 'textarea',
					'std' => ''
				),
				array(
					'name' => 'Image',
					'desc' => $descCardImage,
					'id' => 'home_card_img_2',
					'type' => 'media',
					'std' => ''
				),
				array(
					'name' => 'Event date/time',
					'desc' => '',
					'id' => 'home_card_date_2',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Expire date/time',
					'desc' => $descExpire,
					'id' => 'home_card_expire_2',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Fallback',
					'desc' => $descFallback,
					'id' => 'home_card_fallback_2',
					'type' => 'select',
					'options' => array('What’s on', 'Latest news', 'Latest blog post')
				)
			)
		),
		array(
			'id' => 'home_card_3',
			'title' => 'Homepage card 3 - top right position',
			'pages' => 'page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Content URL*',
					'desc' => $descUrl,
					'id' => 'home_card_url_3',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Title',
					'desc' => $descCardTitle,
					'id' => 'home_card_title_3',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Excerpt',
					'desc' => '',
					'id' => 'home_card_excerpt_3',
					'type' => 'textarea',
					'std' => ''
				),
				array(
					'name' => 'Image',
					'desc' => $descCardImage,
					'id' => 'home_card_img_3',
					'type' => 'media',
					'std' => ''
				),
				array(
					'name' => 'Event date/time',
					'desc' => '',
					'id' => 'home_card_date_3',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Expire date/time',
					'desc' => $descExpire,
					'id' => 'home_card_expire_3',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Fallback',
					'desc' => $descFallback,
					'id' => 'home_card_fallback_3',
					'type' => 'select',
					'options' => array('What’s on', 'Latest news', 'Latest blog post')
				)
			)
		),
		array(
			'id' => 'home_card_4',
			'title' => 'Homepage card 4 - bottom left position',
			'pages' => 'page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Content URL*',
					'desc' => $descUrl,
					'id' => 'home_card_url_4',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Title',
					'desc' => $descCardTitle,
					'id' => 'home_card_title_4',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Excerpt',
					'desc' => '',
					'id' => 'home_card_excerpt_4',
					'type' => 'textarea',
					'std' => ''
				),
				array(
					'name' => 'Image',
					'desc' => $descCardImage,
					'id' => 'home_card_img_4',
					'type' => 'media',
					'std' => ''
				),
				array(
					'name' => 'Event date/time',
					'desc' => '',
					'id' => 'home_card_date_4',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Expire date/time',
					'desc' => $descExpire,
					'id' => 'home_card_expire_4',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Fallback',
					'desc' => $descFallback,
					'id' => 'home_card_fallback_4',
					'type' => 'select',
					'options' => array('What’s on', 'Latest news', 'Latest blog post')
				)
			)
		),
		array(
			'id' => 'home_card_5',
			'title' => 'Homepage card 5 - bottom middle position',
			'pages' => 'page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Content URL*',
					'desc' => $descUrl,
					'id' => 'home_card_url_5',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Title',
					'desc' => $descCardTitle,
					'id' => 'home_card_title_5',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Excerpt',
					'desc' => '',
					'id' => 'home_card_excerpt_5',
					'type' => 'textarea',
					'std' => ''
				),
				array(
					'name' => 'Image',
					'desc' => $descCardImage,
					'id' => 'home_card_img_5',
					'type' => 'media',
					'std' => ''
				),
				array(
					'name' => 'Event date/time',
					'desc' => '',
					'id' => 'home_card_date_5',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Expire date/time',
					'desc' => $descExpire,
					'id' => 'home_card_expire_5',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Fallback',
					'desc' => $descFallback,
					'id' => 'home_card_fallback_5',
					'type' => 'select',
					'options' => array('What’s on', 'Latest news', 'Latest blog post')
				)
			)
		),
		array(
			'id' => 'home_card_6',
			'title' => 'Homepage card 6 - bottom right position',
			'pages' => 'page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => 'Content URL*',
					'desc' => $descUrl,
					'id' => 'home_card_url_6',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Title',
					'desc' => $descCardTitle,
					'id' => 'home_card_title_6',
					'type' => 'text',
					'std' => ''
				),
				array(
					'name' => 'Excerpt',
					'desc' => '',
					'id' => 'home_card_excerpt_6',
					'type' => 'textarea',
					'std' => ''
				),
				array(
					'name' => 'Image',
					'desc' => $descCardImage,
					'id' => 'home_card_img_6',
					'type' => 'media',
					'std' => ''
				),
				array(
					'name' => 'Event date/time',
					'desc' => '',
					'id' => 'home_card_date_6',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Expire date/time',
					'desc' => $descExpire,
					'id' => 'home_card_expire_6',
					'type' => 'datetime',
					'std' => ''
				),
				array(
					'name' => 'Fallback',
					'desc' => $descFallback,
					'id' => 'home_card_fallback_6',
					'type' => 'select',
					'options' => array('What’s on', 'Latest news', 'Latest blog post')
				)
			)
		)
	);

	if( is_homepage_template() ) {
		foreach ( $home_meta_boxes as $meta_box ) {
			$home_box = new CreateMetaBox( $meta_box );
		}
	}
}
