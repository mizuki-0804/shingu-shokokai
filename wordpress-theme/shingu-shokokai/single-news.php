<?php
/**
 * お知らせ1件のページ。
 * リンク先URLが入っているお知らせは一覧から直接そのURLへ飛ぶため、
 * このページは「本文を書いたお知らせ」を読むときに使われます。
 */
get_header();
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">お知らせ一覧</a><span>/</span>
        <b><?php the_title(); ?></b>
      </nav>

      <?php while ( have_posts() ) : the_post(); ?>
        <?php
		$terms = get_the_terms( get_the_ID(), 'news_tag' );
		$tag   = ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ) ? $terms[0]->name : '';
		?>
      <section class="dir-hero">
        <p class="eyebrow">News</p>
        <h1><?php the_title(); ?></h1>
        <p class="dir-lead">
          <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
          <?php if ( $tag ) : ?><span class="news-tag"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
        </p>
      </section>

      <section class="section businesses-section">
        <div class="article-body">
          <?php the_content(); ?>
        </div>
        <p class="news-more">
          <a class="button-ghost" href="<?php echo esc_url( home_url( '/news/' ) ); ?>"><span>お知らせ一覧へ戻る</span></a>
        </p>
      </section>
      <?php endwhile; ?>
    </main>

<?php get_footer(); ?>
