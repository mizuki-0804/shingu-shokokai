<?php
/**
 * Template Name: お知らせ一覧
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 * 管理画面の「お知らせ」に登録した内容が、新しい順に並びます。
 */
get_header();

$news_query = new WP_Query(
	array(
		'post_type'      => 'news',
		'posts_per_page' => 30,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <b>お知らせ一覧</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">News</p>
        <h1>商工会からのお知らせ</h1>
        <p class="dir-lead">補助金・セミナー・表彰など、新宮町商工会からのお知らせをまとめて確認できます。各お知らせは新宮町の発信元ページで詳しい内容をご覧いただけます。</p>
      </section>

      <section class="section businesses-section" aria-labelledby="news-list-title">
        <div class="section-heading split-heading">
          <div>
            <p class="eyebrow">All Notices</p>
            <h2 id="news-list-title">お知らせ一覧</h2>
          </div>
        </div>

        <div class="news-list">
          <?php if ( $news_query->have_posts() ) : ?>
            <?php
			while ( $news_query->have_posts() ) :
				$news_query->the_post();
				$link  = shingu_shokokai_news_link( get_the_ID() );
				$terms = get_the_terms( get_the_ID(), 'news_tag' );
				$tag   = ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ) ? $terms[0]->name : '';
				?>
          <a href="<?php echo esc_url( $link['url'] ); ?>"<?php echo $link['external'] ? ' target="_blank" rel="noreferrer"' : ''; ?>>
            <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
            <?php if ( $tag ) : ?><span class="news-tag"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
            <h3><?php the_title(); ?></h3>
          </a>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php else : ?>
            <p class="empty">お知らせはまだありません。</p>
          <?php endif; ?>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
