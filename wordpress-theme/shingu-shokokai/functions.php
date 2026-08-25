<?php
/**
 * shingu-shokokai theme functions
 * 静的サイト（prototype/）のCSS/JSをそのまま読み込んで、見た目を再現する検証用テーマ。
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function shingu_shokokai_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'primary' => __( '主要ナビゲーション', 'shingu-shokokai' ),
		)
	);
}
add_action( 'after_setup_theme', 'shingu_shokokai_setup' );

/**
 * 会員企業（business）投稿タイプと業種タクソノミー。
 */
function shingu_shokokai_register_business_cpt() {
	register_post_type(
		'business',
		array(
			'labels'       => array(
				'name'          => '会員企業',
				'singular_name' => '会員企業',
				'add_new_item'  => '会員企業を追加',
				'edit_item'     => '会員企業を編集',
			),
			'public'       => true,
			'has_archive'  => false,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-store',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'      => array( 'slug' => 'business' ),
		)
	);

	register_taxonomy(
		'gyoshu',
		'business',
		array(
			'label'             => '業種',
			'hierarchical'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'gyoshu' ),
		)
	);
}
add_action( 'init', 'shingu_shokokai_register_business_cpt' );

/**
 * お知らせ（news）投稿タイプ。
 * 補助金・セミナーなどの案内を、職員さんが管理画面から追加・修正できるようにする。
 * 「リンク先URL」を入れた場合は、その外部ページ（新宮町の発信元など）へ直接飛ばす。
 */
function shingu_shokokai_register_news_cpt() {
	register_post_type(
		'news',
		array(
			'labels'       => array(
				'name'          => 'お知らせ',
				'singular_name' => 'お知らせ',
				'add_new_item'  => 'お知らせを追加',
				'edit_item'     => 'お知らせを編集',
			),
			'public'       => true,
			'has_archive'  => false,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-megaphone',
			'supports'     => array( 'title', 'editor', 'excerpt' ),
			'rewrite'      => array( 'slug' => 'oshirase' ),
		)
	);

	register_taxonomy(
		'news_tag',
		'news',
		array(
			'label'             => 'お知らせの種類',
			'hierarchical'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'news-tag' ),
		)
	);

	register_post_meta(
		'news',
		'external_url',
		array(
			'type'         => 'string',
			'single'       => true,
			'show_in_rest' => true,
			'auth_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		)
	);
}
add_action( 'init', 'shingu_shokokai_register_news_cpt' );

/**
 * お知らせ編集画面に「リンク先URL」の入力欄を出す。
 */
function shingu_shokokai_news_meta_box() {
	add_meta_box(
		'shingu-news-link',
		'リンク先URL（任意）',
		function ( $post ) {
			wp_nonce_field( 'shingu_news_link', 'shingu_news_link_nonce' );
			$value = get_post_meta( $post->ID, 'external_url', true );
			echo '<p>別のページ（新宮町の発信元など）を読ませたいときだけ入力してください。空欄なら、このお知らせ自身のページが開きます。</p>';
			echo '<input type="url" name="shingu_news_external_url" value="' . esc_attr( $value ) . '" style="width:100%" placeholder="https://..." />';
		},
		'news',
		'side'
	);
}
add_action( 'add_meta_boxes', 'shingu_shokokai_news_meta_box' );

function shingu_shokokai_save_news_meta( $post_id ) {
	if ( ! isset( $_POST['shingu_news_link_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['shingu_news_link_nonce'] ) ), 'shingu_news_link' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$url = isset( $_POST['shingu_news_external_url'] ) ? esc_url_raw( wp_unslash( $_POST['shingu_news_external_url'] ) ) : '';
	if ( $url ) {
		update_post_meta( $post_id, 'external_url', $url );
	} else {
		delete_post_meta( $post_id, 'external_url' );
	}
}
add_action( 'save_post_news', 'shingu_shokokai_save_news_meta' );

/**
 * お知らせ1件の「表示するリンク先」と「外部リンクかどうか」を返す。
 */
function shingu_shokokai_news_link( $post_id ) {
	$external = get_post_meta( $post_id, 'external_url', true );
	return array(
		'url'      => $external ? $external : get_permalink( $post_id ),
		'external' => (bool) $external,
	);
}

/**
 * assets/ 内のファイルは編集頻度が高いため、テーマのVersionではなく
 * ファイルの更新日時をバージョンにして、ブラウザキャッシュが古いまま
 * 残らないようにする。
 */
function shingu_shokokai_asset_ver( $relative_path ) {
	$file = get_stylesheet_directory() . $relative_path;
	return file_exists( $file ) ? filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

function shingu_shokokai_assets() {
	$theme_uri = get_stylesheet_directory_uri();

	wp_enqueue_style(
		'google-fonts',
		'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700;900&family=Space+Grotesk:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@400;500;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'shingu-home', $theme_uri . '/assets/home.css', array(), shingu_shokokai_asset_ver( '/assets/home.css' ) );
	wp_enqueue_style( 'shingu-directory', $theme_uri . '/assets/directory.css', array( 'shingu-home' ), shingu_shokokai_asset_ver( '/assets/directory.css' ) );
	wp_enqueue_style( 'shingu-article', $theme_uri . '/assets/article.css', array( 'shingu-home' ), shingu_shokokai_asset_ver( '/assets/article.css' ) );
	wp_enqueue_style( 'shingu-wp-adjustments', $theme_uri . '/assets/wp-adjustments.css', array( 'shingu-home' ), shingu_shokokai_asset_ver( '/assets/wp-adjustments.css' ) );

	// home.js はヒーロー（.hero）がある前提のスクロール処理を含むため、
	// ヒーローの無いサブページで動かすとヘッダーの文字色がおかしくなる。
	// 元の静的サイトと同じく、トップページだけに読み込む。
	if ( is_front_page() ) {
		wp_enqueue_script( 'shingu-data', $theme_uri . '/assets/data.js', array(), shingu_shokokai_asset_ver( '/assets/data.js' ), true );
		wp_enqueue_script( 'shingu-home-js', $theme_uri . '/assets/home.js', array( 'shingu-data' ), shingu_shokokai_asset_ver( '/assets/home.js' ), true );
	} elseif ( is_singular( 'post' ) || is_singular( 'business' ) || is_page_template( 'template-articles.php' ) || is_page_template( 'template-businesses.php' ) ) {
		// 記事・会員企業まわりのページは article.js（いいねボタン・スクロール演出・モバイルメニュー）を使う。
		wp_enqueue_script( 'shingu-article-js', $theme_uri . '/assets/article.js', array(), shingu_shokokai_asset_ver( '/assets/article.js' ), true );
	}
}
add_action( 'wp_enqueue_scripts', 'shingu_shokokai_assets' );
