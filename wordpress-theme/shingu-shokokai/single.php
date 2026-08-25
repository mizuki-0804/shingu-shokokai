<?php
/**
 * 個別の記事（投稿）テンプレート。
 * article-story.html 等の見た目を、実際の投稿データで再現する。
 */
get_header();

while ( have_posts() ) :
	the_post();

	$cats = get_the_category();
	$cat_name = ! empty( $cats ) ? $cats[0]->name : '地域記事';
	$tags = get_the_tags();

	$word_count   = mb_strlen( wp_strip_all_tags( get_the_content() ) );
	$read_minutes = max( 1, (int) round( $word_count / 600 ) );
	?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <a href="<?php echo esc_url( home_url( '/articles/' ) ); ?>">地域記事</a><span>/</span>
        <b><?php the_title(); ?></b>
      </nav>

      <article>
        <div class="article">
          <p class="article-eyebrow">
            <span class="cat"><?php echo esc_html( $cat_name ); ?></span>
            <?php
            if ( $tags ) {
                echo esc_html( '#' . $tags[0]->name );
            }
            ?>
          </p>
          <h1 class="article-title"><?php the_title(); ?></h1>
          <div class="article-meta">
            <span class="author"><span class="avatar">新</span>新宮町商工会 編集部</span>
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
            <span>読了 約<?php echo (int) $read_minutes; ?>分</span>
          </div>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
        <div class="article-cover">
          <figure>
            <?php the_post_thumbnail( 'large' ); ?>
          </figure>
        </div>
        <?php endif; ?>

        <div class="article-body">
          <?php the_content(); ?>
        </div>

        <div class="article-foot">
          <?php if ( $tags ) : ?>
          <div class="article-tags">
            <?php foreach ( $tags as $tag ) : ?>
              <a href="<?php echo esc_url( get_tag_link( $tag ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <div class="article-foot-row">
            <button class="like-button" type="button" data-like-id="post-<?php the_ID(); ?>" data-like-base="24" aria-label="この記事にいいねする" aria-pressed="false">
              <span class="like-icon" aria-hidden="true">♥</span>
              <span class="like-label">いいね</span>
              <strong>24</strong>
            </button>
            <div class="share-row">
              <span>シェア</span>
              <a href="#" aria-label="Xでシェア">X</a>
              <a href="#" aria-label="Facebookでシェア">f</a>
              <a href="#" aria-label="LINEでシェア">L</a>
            </div>
          </div>
        </div>
      </article>

      <?php
      $related = new WP_Query(
			array(
				'post_type'           => 'post',
				'posts_per_page'      => 3,
				'post__not_in'        => array( get_the_ID() ),
				'category__in'        => wp_list_pluck( $cats, 'term_id' ),
				'ignore_sticky_posts' => true,
			)
		);
      if ( $related->have_posts() ) :
      ?>
      <section class="related">
        <div class="related-head"><em>RELATED</em><h2>あわせて読む</h2></div>
        <div class="related-grid">
          <?php while ( $related->have_posts() ) : $related->the_post(); ?>
          <a class="related-card" href="<?php the_permalink(); ?>">
            <div class="rc-media">
              <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium' ); } ?>
            </div>
            <?php $rcats = get_the_category(); ?>
            <span class="rc-cat"><?php echo ! empty( $rcats ) ? esc_html( $rcats[0]->name ) : ''; ?></span>
            <h3><?php the_title(); ?></h3>
          </a>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </section>
      <?php endif; ?>
    </main>

<?php endwhile; ?>

<?php get_footer(); ?>
