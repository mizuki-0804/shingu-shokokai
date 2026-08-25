<?php
/**
 * 汎用フォールバックテンプレート（WordPressの仕様上どのテーマにも必要）。
 * 検証の主目的はトップページ（front-page.php）なので、ここは簡易表示のみ。
 */
get_header();
?>
    <main id="top" class="subpage">
      <div class="section" style="padding-bottom: 96px;">
        <?php if ( have_posts() ) : ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?>>
              <h1><?php the_title(); ?></h1>
              <div><?php the_content(); ?></div>
            </article>
          <?php endwhile; ?>
        <?php else : ?>
          <p>コンテンツが見つかりませんでした。</p>
        <?php endif; ?>
      </div>
    </main>
<?php get_footer(); ?>
