<?php
/**
 * Template Name: 会員企業一覧
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 * ?category=業種名 ?area=エリア名 で絞り込めます。
 */
get_header();

$selected_cat_name = isset( $_GET['category'] ) ? sanitize_text_field( wp_unslash( $_GET['category'] ) ) : '';
$selected_area      = isset( $_GET['area'] ) ? sanitize_text_field( wp_unslash( $_GET['area'] ) ) : '';
$selected_term      = $selected_cat_name ? get_term_by( 'name', $selected_cat_name, 'gyoshu' ) : false;

$query_args = array(
	'post_type'      => 'business',
	'posts_per_page' => -1,
	'meta_key'       => 'plan_rank',
	'orderby'        => 'meta_value_num',
	'order'          => 'ASC',
);
if ( $selected_term ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'gyoshu',
			'field'    => 'term_id',
			'terms'    => $selected_term->term_id,
		),
	);
}
if ( $selected_area ) {
	$query_args['meta_query'] = array(
		array(
			'key'   => 'area',
			'value' => $selected_area,
		),
	);
}
$business_query = new WP_Query( $query_args );

$gyoshu_terms = get_terms(
	array(
		'taxonomy'   => 'gyoshu',
		'hide_empty' => true,
	)
);

// エリアの一覧は投稿から拾い集める（件数が少ないため一括取得で十分）
$all_areas   = array();
$all_business_ids = get_posts(
	array(
		'post_type'      => 'business',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	)
);
foreach ( $all_business_ids as $bid ) {
	$a = get_post_meta( $bid, 'area', true );
	if ( $a && ! in_array( $a, $all_areas, true ) ) {
		$all_areas[] = $a;
	}
}
sort( $all_areas );

// 「掲載中の企業」の数は、実際に登録されている件数に連動させる
$listed_total = count( $all_business_ids );

// 10万円・5万円プラン（plan_rank 3未満）のみ、記事のような詳しい紹介ページに飛べる
function shingu_has_detail_page( $plan_rank ) {
	return (float) $plan_rank < 3;
}

function shingu_plan_tier_class( $plan_rank ) {
	$plan_rank = (float) $plan_rank;
	if ( $plan_rank < 2 ) {
		return 'plan-tier-10';
	}
	if ( $plan_rank < 3 ) {
		return 'plan-tier-5';
	}
	if ( $plan_rank < 4 ) {
		return 'plan-tier-3';
	}
	if ( $plan_rank < 5 ) {
		return 'plan-tier-1';
	}
	return 'plan-tier-pending';
}
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <b>新宮町の企業一覧</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">Business Directory</p>
        <h1>町内のお店・事業者を探す</h1>
        <p class="dir-lead">暮らしや仕事で必要な地元の情報を、業種やエリアからすぐに探せます。企業名や所在地、連絡先、ホームページ、SNSまでまとめて確認できます。</p>
        <p class="dir-count"><strong><?php echo (int) $listed_total; ?></strong><span>このサイトに掲載中の企業</span></p>
      </section>

      <section class="section businesses-section" aria-labelledby="business-list-title">
        <div class="section-heading split-heading">
          <div>
            <p class="eyebrow">Search</p>
            <h2 id="business-list-title">新宮町の企業一覧</h2>
          </div>
          <p>業種・エリアから絞り込めます。</p>
        </div>

        <form class="filters" aria-label="絞り込み条件" method="get">
          <label>
            業種
            <select name="category" onchange="this.form.submit()">
              <option value="">すべて</option>
              <?php foreach ( $gyoshu_terms as $term ) : ?>
                <option value="<?php echo esc_attr( $term->name ); ?>" <?php selected( $selected_cat_name, $term->name ); ?>><?php echo esc_html( $term->name ); ?></option>
              <?php endforeach; ?>
            </select>
          </label>
          <label>
            エリア
            <select name="area" onchange="this.form.submit()">
              <option value="">すべて</option>
              <?php foreach ( $all_areas as $area ) : ?>
                <option value="<?php echo esc_attr( $area ); ?>" <?php selected( $selected_area, $area ); ?>><?php echo esc_html( $area ); ?></option>
              <?php endforeach; ?>
            </select>
          </label>
        </form>
        <div class="filter-shortcuts" role="tablist" aria-label="業種で絞り込み">
          <span>業種で絞る</span>
          <a href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>" role="tab" class="<?php echo '' === $selected_cat_name ? 'is-active' : ''; ?>">すべて</a>
          <?php foreach ( $gyoshu_terms as $term ) : ?>
            <a href="<?php echo esc_url( add_query_arg( 'category', $term->name, home_url( '/businesses/' ) ) ); ?>" role="tab" class="<?php echo $selected_cat_name === $term->name ? 'is-active' : ''; ?>"><?php echo esc_html( $term->name ); ?></a>
          <?php endforeach; ?>
        </div>

        <div class="list-status">
          <span id="result-count"><?php echo (int) $business_query->found_posts; ?>件</span>
          <?php if ( $selected_cat_name || $selected_area ) : ?>
            <a id="reset-filters" href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>">条件をクリア</a>
          <?php endif; ?>
        </div>
        <p class="plan-size-note">掲載カードの大きさ・表示順は掲載プラン（10万円・5万円・1万円）によって変わります。1万円プランはロゴと社名のみの掲載です。</p>

        <div id="business-list" class="business-list directory-list">
          <?php if ( $business_query->have_posts() ) : ?>
            <?php
			while ( $business_query->have_posts() ) :
				$business_query->the_post();
				$post_id     = get_the_ID();
				$plan_label  = get_post_meta( $post_id, 'plan_label', true );
				$plan_rank   = get_post_meta( $post_id, 'plan_rank', true );
				$area        = get_post_meta( $post_id, 'area', true );
				$address     = get_post_meta( $post_id, 'address', true );
				$phone       = get_post_meta( $post_id, 'phone', true );
				$website     = get_post_meta( $post_id, 'website', true );
				$instagram   = get_post_meta( $post_id, 'instagram', true );
				$terms       = get_the_terms( $post_id, 'gyoshu' );
				$cat_name    = ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ) ? $terms[0]->name : '';
				$tier_class  = shingu_plan_tier_class( $plan_rank );
				$map_url     = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $address );
				?>
            <?php if ( ! shingu_has_detail_page( $plan_rank ) ) : ?>
              <?php
				// 1万円プラン：ロゴと社名だけの最小カード。
				// 自社サイトがあればそのままサイトへ、無ければ最小限の紹介ページへ飛ぶ。
				$minimal_href     = $website ? $website : get_permalink();
				$minimal_external = (bool) $website;
				?>
            <a class="business-card minimal-card" href="<?php echo esc_url( $minimal_href ); ?>"<?php echo $minimal_external ? ' target="_blank" rel="noreferrer"' : ''; ?>>
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() . 'のロゴ' ) ); ?>
              <?php endif; ?>
              <div class="business-card-body">
                <h3><?php the_title(); ?></h3>
              </div>
            </a>
            <?php else : ?>
            <article class="business-card <?php echo esc_attr( $tier_class ); ?> <?php echo ( (float) $plan_rank ) < 2 ? 'premium' : ''; ?>">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() . 'のイメージ写真' ) ); ?>
              <?php endif; ?>
              <div class="business-card-body">
                <span class="plan-badge"><?php echo esc_html( $plan_label ); ?></span>
                <h3><?php the_title(); ?></h3>
                <p class="business-meta"><?php echo esc_html( $cat_name . ' / ' . $area ); ?></p>
                <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                <dl class="card-info">
                  <div><dt>所在地</dt><dd><?php echo esc_html( $address ); ?></dd></div>
                  <div><dt>電話</dt><dd><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></dd></div>
                </dl>
                <div class="card-links">
                  <?php if ( $website ) : ?><a href="<?php echo esc_url( $website ); ?>" target="_blank" rel="noreferrer">公式サイト</a><?php endif; ?>
                  <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noreferrer">Googleマップ</a>
                  <?php if ( $instagram ) : ?><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noreferrer">Instagram</a><?php endif; ?>
                  <a class="card-detail-link" href="<?php the_permalink(); ?>">詳しく見る</a>
                </div>
              </div>
            </article>
            <?php endif; ?>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php else : ?>
            <p class="empty">条件に合う事業者が見つかりませんでした。</p>
          <?php endif; ?>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
