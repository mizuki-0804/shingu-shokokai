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
        <h1>新宮町の企業一覧</h1>
        <p class="dir-lead">業種やエリアから、町内のお店・会社を探せます。連絡先やホームページもまとめて確認できます。</p>
        <p class="dir-count"><strong><?php echo (int) $listed_total; ?></strong><span>このサイトに掲載中の企業</span></p>
      </section>

      <section class="section businesses-section" aria-label="新宮町の企業一覧">
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
        <p class="plan-size-note">掲載カードの大きさ・表示順は掲載プラン（10万円・5万円・1万円）によって変わります。1万円プランはロゴ（無い場合は社名）のみの掲載です。</p>

        <?php
		// 掲載順は「プランの優先順位は固定、同じ料金の中だけ毎回入れ替え」。
		// 有料プラン（10万円・5万円）はカード、1万円プランはロゴだけの一覧に分けて出す。
		$ordered = shingu_shokokai_order_by_plan( $business_query->posts );
		$carded  = array();
		$logos   = array();
		foreach ( $ordered as $business_post ) {
			if ( shingu_shokokai_has_detail_page( $business_post->ID ) ) {
				$carded[] = $business_post;
			} else {
				$logos[] = $business_post;
			}
		}
		?>

        <div id="business-list" class="business-list directory-list">
          <?php if ( empty( $ordered ) ) : ?>
            <p class="empty">条件に合う事業者が見つかりませんでした。</p>
          <?php endif; ?>
          <?php
			foreach ( $carded as $business_post ) :
				setup_postdata( $GLOBALS['post'] = $business_post ); // phpcs:ignore
				$post_id    = $business_post->ID;
				$plan_label = get_post_meta( $post_id, 'plan_label', true );
				$plan_rank  = get_post_meta( $post_id, 'plan_rank', true );
				$area       = get_post_meta( $post_id, 'area', true );
				$address    = get_post_meta( $post_id, 'address', true );
				$phone      = get_post_meta( $post_id, 'phone', true );
				$website    = get_post_meta( $post_id, 'website', true );
				$instagram  = get_post_meta( $post_id, 'instagram', true );
				$terms      = get_the_terms( $post_id, 'gyoshu' );
				$cat_name   = ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ) ? $terms[0]->name : '';
				$tier_class = shingu_plan_tier_class( $plan_rank );
				$map_url    = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $address );
				?>
          <article class="business-card <?php echo esc_attr( $tier_class ); ?> <?php echo ( (float) $plan_rank ) < 2 ? 'premium' : ''; ?>">
            <?php if ( has_post_thumbnail( $post_id ) ) : ?>
              <?php echo get_the_post_thumbnail( $post_id, 'medium_large', array( 'alt' => get_the_title( $post_id ) . 'のイメージ写真' ) ); ?>
            <?php endif; ?>
            <div class="business-card-body">
              <span class="plan-badge"><?php echo esc_html( $plan_label ); ?></span>
              <h3><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
              <p class="business-meta"><?php echo esc_html( $cat_name . ' / ' . $area ); ?></p>
              <p><?php echo esc_html( get_the_excerpt( $post_id ) ); ?></p>
              <dl class="card-info">
                <div><dt>所在地</dt><dd><?php echo esc_html( $address ); ?></dd></div>
                <div><dt>電話</dt><dd><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></dd></div>
              </dl>
              <div class="card-links">
                <?php if ( $website ) : ?><a href="<?php echo esc_url( $website ); ?>" target="_blank" rel="noreferrer">公式サイト</a><?php endif; ?>
                <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noreferrer">Googleマップ</a>
                <?php if ( $instagram ) : ?><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noreferrer">Instagram</a><?php endif; ?>
                <a class="card-detail-link" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">詳しく見る</a>
              </div>
            </div>
          </article>
          <?php endforeach; wp_reset_postdata(); ?>
        </div>

        <div id="logo-wall-block" class="logo-wall-block"<?php echo empty( $logos ) ? ' hidden' : ''; ?>>
          <p class="logo-wall-label">1万円プラン<small>ロゴ（無い場合は社名）のみの掲載です</small></p>
          <div id="business-logo-wall" class="logo-wall">
            <?php
			foreach ( $logos as $business_post ) :
				$post_id  = $business_post->ID;
				$website  = get_post_meta( $post_id, 'website', true );
				$logo_id  = get_post_meta( $post_id, 'logo_id', true );
				$href     = $website ? $website : get_permalink( $post_id );
				$name     = get_the_title( $post_id );
				?>
            <a class="logo-tile" href="<?php echo esc_url( $href ); ?>"<?php echo $website ? ' target="_blank" rel="noreferrer"' : ''; ?> title="<?php echo esc_attr( $name ); ?>">
              <?php if ( $logo_id ) : ?>
                <?php echo wp_get_attachment_image( (int) $logo_id, 'medium', false, array( 'class' => 'logo-tile-img', 'alt' => $name . 'のロゴ' ) ); ?>
              <?php else : ?>
                <span class="logo-tile-name"><?php echo esc_html( $name ); ?></span>
              <?php endif; ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
