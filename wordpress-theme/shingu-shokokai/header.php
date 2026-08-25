<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class( is_front_page() ? '' : 'subpage' ); ?>>
    <?php wp_body_open(); ?>

    <div class="page-progress" aria-hidden="true"><i></i></div>

    <header class="site-header<?php echo ! is_front_page() ? ' is-scrolled' : ''; ?>" id="site-header">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="新宮町商工会 トップへ">
        <span class="brand-mark">新</span>
        <span class="brand-text">
          <strong>新宮町商工会</strong>
          <small>SHINGUMACHI SHOKOKAI</small>
        </span>
      </a>
      <nav class="site-nav" aria-label="主要ナビゲーション">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a>
        <a href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>">新宮町の企業</a>
        <a href="<?php echo esc_url( home_url( '/nyukai/' ) ); ?>">入会案内</a>
        <div class="nav-item has-dropdown">
          <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について<span class="nav-caret" aria-hidden="true">▾</span></a>
          <div class="nav-dropdown">
            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について（全体）</a>
            <a href="<?php echo esc_url( home_url( '/yakuin/' ) ); ?>">役員紹介</a>
            <a href="<?php echo esc_url( home_url( '/shien/' ) ); ?>">支援メニュー</a>
            <a href="<?php echo esc_url( home_url( '/kaikan/' ) ); ?>">会館使用</a>
            <a href="<?php echo esc_url( home_url( '/gaiyo/' ) ); ?>">概要・アクセス</a>
          </div>
        </div>
        <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">お知らせ</a>
      </nav>
      <a class="header-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>相談する</span></a>
      <button class="menu-toggle" id="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu" aria-label="メニューを開く">
        <i></i><i></i>
      </button>
    </header>

    <nav class="mobile-menu" id="mobile-menu" aria-label="モバイルメニュー" hidden>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a>
      <a href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>">新宮町の企業一覧</a>
      <a href="<?php echo esc_url( home_url( '/nyukai/' ) ); ?>">入会案内</a>
      <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について</a>
      <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">お知らせ</a>
      <a class="mobile-menu-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">商工会に相談する</a>
    </nav>
