<?php
/**
 * 会員企業の詳細ページ（充実した紹介ページを持つ企業のみ）。
 */
get_header();

while ( have_posts() ) :
	the_post();

	$post_id    = get_the_ID();
	$plan_label = get_post_meta( $post_id, 'plan_label', true );
	$area       = get_post_meta( $post_id, 'area', true );
	$phone      = get_post_meta( $post_id, 'phone', true );
	$email      = get_post_meta( $post_id, 'email', true );
	$address    = get_post_meta( $post_id, 'address', true );
	$hours      = get_post_meta( $post_id, 'hours', true );
	$closed     = get_post_meta( $post_id, 'closed', true );
	$website    = get_post_meta( $post_id, 'website', true );
	$instagram  = get_post_meta( $post_id, 'instagram', true );
	$payment    = get_post_meta( $post_id, 'payment', true );
	$gallery    = get_post_meta( $post_id, 'gallery_ids', true );
	$cases_json = get_post_meta( $post_id, 'cases_json', true );
	$cases      = $cases_json ? json_decode( $cases_json, true ) : array();
	$tags       = get_the_tags();
	$map_url    = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $address );
	?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <a href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>">会員企業一覧</a><span>/</span>
        <b><?php the_title(); ?></b>
      </nav>

      <section class="detail-hero">
        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'large', array( 'alt' => get_the_title() . 'のメイン写真' ) ); } ?>
        <div>
          <span class="plan-badge"><?php echo esc_html( $plan_label ); ?></span>
          <?php $terms = get_the_terms( $post_id, 'gyoshu' ); ?>
          <p class="eyebrow"><?php echo esc_html( ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ? $terms[0]->name : '' ) . ' / ' . $area ); ?></p>
          <h1><?php the_title(); ?></h1>
          <p><?php echo esc_html( get_the_excerpt() ); ?></p>
          <div class="detail-actions">
            <?php if ( $website ) : ?><a href="<?php echo esc_url( $website ); ?>" target="_blank" rel="noreferrer">公式サイト</a><?php endif; ?>
            <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noreferrer">Googleマップ</a>
            <?php if ( $instagram ) : ?><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noreferrer">Instagram</a><?php endif; ?>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone ) ); ?>">電話</a>
          </div>
        </div>
      </section>

      <section class="section detail-two-column">
        <div>
          <h2>企業紹介</h2>
          <p><?php the_content(); ?></p>
          <?php if ( $tags ) : ?>
          <div class="tag-row">
            <?php foreach ( $tags as $tag ) : ?>
              <span><?php echo esc_html( $tag->name ); ?></span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <dl class="info-list">
            <div><dt>所在地</dt><dd><?php echo esc_html( $address ); ?></dd></div>
            <div><dt>電話</dt><dd><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></dd></div>
            <div><dt>メール</dt><dd><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></dd></div>
            <div><dt>営業時間</dt><dd><?php echo esc_html( $hours ); ?></dd></div>
            <div><dt>定休日</dt><dd><?php echo esc_html( $closed ); ?></dd></div>
            <div><dt>決済</dt><dd><?php echo esc_html( $payment ); ?></dd></div>
          </dl>
        </div>
        <aside class="contact-panel">
          <h2>すぐ確認できる情報</h2>
          <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone ) ); ?>">電話する</a>
          <a href="mailto:<?php echo esc_attr( $email ); ?>">メールする</a>
          <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noreferrer">Googleマップで開く</a>
          <?php if ( $website ) : ?><a href="<?php echo esc_url( $website ); ?>" target="_blank" rel="noreferrer">ホームページ</a><?php endif; ?>
          <?php if ( $instagram ) : ?><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noreferrer">Instagram</a><?php endif; ?>
        </aside>
      </section>

      <?php if ( $gallery ) : ?>
      <section class="section gallery-section">
        <div class="section-heading">
          <p class="eyebrow">Photo Gallery</p>
          <h2>写真ギャラリー</h2>
          <p>お店や会社の雰囲気、商品・サービスの様子を写真で確認できます。</p>
        </div>
        <div class="gallery-grid">
          <?php foreach ( explode( ',', $gallery ) as $attachment_id ) : ?>
            <?php echo wp_get_attachment_image( (int) $attachment_id, 'medium_large', false, array( 'alt' => get_the_title() . ' 写真' ) ); ?>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <?php if ( $cases ) : ?>
      <section class="section video-case-section">
        <div class="video-frame video-frame-placeholder">
          <p class="eyebrow">Interview Note</p>
          <h2>取材記事として読める紹介枠</h2>
          <p>写真、事例、相談できる内容をまとめ、初めて見る人にも事業内容が伝わる構成にしています。</p>
        </div>
        <div>
          <p class="eyebrow">Works / Products</p>
          <h2>施工事例・商品紹介</h2>
          <div class="case-list">
            <?php foreach ( $cases as $case_item ) : ?>
              <article>
                <h3><?php echo esc_html( $case_item['title'] ); ?></h3>
                <p><?php echo esc_html( $case_item['text'] ); ?></p>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
      <?php endif; ?>
    </main>

    <div class="detail-bottom">
      <a class="button primary" href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>"><span>会員企業一覧へ戻る</span><span aria-hidden="true">→</span></a>
    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
