<?php
/**
 * Template Name: 地域記事一覧
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 * ?category=カテゴリ名 で絞り込めます（ナビの「事業者の声」等のリンクと対応）。
 */
get_header();

$selected_cat_name = isset( $_GET['category'] ) ? sanitize_text_field( wp_unslash( $_GET['category'] ) ) : '';
$selected_term      = $selected_cat_name ? get_term_by( 'name', $selected_cat_name, 'category' ) : false;

$query_args = array(
	'post_type'      => 'post',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
if ( $selected_term ) {
	$query_args['cat'] = $selected_term->term_id;
}
$articles_query = new WP_Query( $query_args );

$categories = get_categories( array( 'hide_empty' => true ) );
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <b>地域記事一覧</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">Stories &amp; News</p>
        <h1>新宮の仕事と暮らしを読む</h1>
        <p class="dir-lead">お店のこだわり、働く人の想い、暮らしに役立つ情報、商工会の活動報告。新宮町の「いま」を記事で紹介します。</p>
      </section>

      <section class="section businesses-section" aria-labelledby="article-list-title">
        <div class="section-heading split-heading">
          <div>
            <p class="eyebrow">Articles</p>
            <h2 id="article-list-title">記事一覧</h2>
          </div>
          <p>カテゴリから読みたい記事を絞り込めます。</p>
        </div>

        <label class="dock-select article-category-select" for="article-category">
          <span class="visually-hidden">カテゴリを選ぶ</span>
          <select
            id="article-category"
            onchange="location.href = this.value ? '<?php echo esc_url( home_url( '/articles/' ) ); ?>?category=' + encodeURIComponent(this.value) : '<?php echo esc_url( home_url( '/articles/' ) ); ?>'"
          >
            <option value="">すべてのカテゴリ</option>
            <?php foreach ( $categories as $c ) : ?>
              <option value="<?php echo esc_attr( $c->name ); ?>" <?php selected( $selected_cat_name, $c->name ); ?>><?php echo esc_html( $c->name ); ?></option>
            <?php endforeach; ?>
          </select>
        </label>

        <div class="list-status">
          <span id="result-count"><?php echo (int) $articles_query->found_posts; ?>件</span>
          <?php if ( $selected_term ) : ?>
            <a id="reset-filters" href="<?php echo esc_url( home_url( '/articles/' ) ); ?>">条件をクリア</a>
          <?php endif; ?>
        </div>

        <div id="article-list" class="feature-grid article-index-grid">
          <?php if ( $articles_query->have_posts() ) : ?>
            <?php while ( $articles_query->have_posts() ) : $articles_query->the_post(); ?>
              <?php $acats = get_the_category(); ?>
              <article class="feature-card">
                <a class="card-media" href="<?php the_permalink(); ?>">
                  <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium_large' ); } ?>
                </a>
                <div class="card-meta">
                  <span><?php echo ! empty( $acats ) ? esc_html( $acats[0]->name ) : ''; ?></span>
                  <time><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                <footer class="article-actions"><small>新宮町商工会</small></footer>
              </article>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php else : ?>
            <p class="placeholder-note">該当する記事がありません。</p>
          <?php endif; ?>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
