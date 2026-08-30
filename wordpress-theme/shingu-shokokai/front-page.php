<?php
/**
 * フロントページ（トップページ）
 * 静的サイト prototype/index.html と同じ構成。内部リンクだけ WordPress のURLに置き換えています。
 * お知らせ・会員企業などを投稿データと連携させるのは、この後のステップです。
 */
get_header();
?>

    <main id="top">
      <!-- ============ HERO ============ -->
      <section class="hero" aria-labelledby="hero-title">
        <div class="hero-media" aria-hidden="true">
          <figure class="hero-slide is-active">
            <img fetchpriority="high" decoding="async" src="https://www.crossroadfukuoka.jp/storage/tourism_attractions/11453/responsive_images/plHyVYdYjfSD4JHmXDMaGJwbAh0hnnABiRD1fG7M__1611_1074.jpg" alt="" />
          </figure>
          <figure class="hero-slide">
            <img loading="lazy" decoding="async" src="https://images.unsplash.com/photo-1556741533-411cf82e4e2d?auto=format&fit=crop&w=1800&q=82" alt="" />
          </figure>
          <figure class="hero-slide">
            <img loading="lazy" decoding="async" src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1800&q=82" alt="" />
          </figure>
          <div class="hero-scrim"></div>
        </div>

        <p class="hero-giant" data-parallax="-0.12" aria-hidden="true">SHINGU</p>

        <div class="hero-inner">
          <p class="hero-kicker" data-hero-seq="1">
            <span class="kicker-line"></span>新宮町商工会 公式ホームページ
          </p>
          <h1 id="hero-title" class="hero-title">
            <span class="hero-line" data-split data-hero-seq="2">新宮町の商売を、</span>
            <span class="hero-line" data-split data-hero-seq="3">元気に、強く。</span>
          </h1>
          <p class="hero-lead" data-hero-seq="4">
            経営のご相談、資金や補助金の情報、事業者同士のつながりづくりまで。<br />
            福岡県糟屋郡新宮町商工会が、まちの商売と暮らしを応援します。
          </p>
          <div class="hero-panels" data-hero-seq="5" aria-label="おすすめのメニュー">
            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><span>ABOUT</span><strong>商工会について知る</strong></a>
            <a href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>"><span>MEMBERS</span><strong>新宮町の企業を探す</strong></a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>SUPPORT</span><strong>商工会に相談する</strong></a>
          </div>
        </div>

        <div class="hero-progress" data-hero-seq="6" aria-label="メインビジュアルの切り替え">
          <button type="button" class="is-active" data-slide="0" aria-label="スライド1を表示"><em>01</em><i></i></button>
          <button type="button" data-slide="1" aria-label="スライド2を表示"><em>02</em><i></i></button>
          <button type="button" data-slide="2" aria-label="スライド3を表示"><em>03</em><i></i></button>
        </div>

        <a class="hero-scroll" href="#search-dock" data-hero-seq="6"><span>SCROLL</span><i aria-hidden="true"></i></a>
      </section>

      <!-- ============ CATEGORY DOCK（業種から探す） ============ -->
      <section class="search-dock" id="search-dock" aria-labelledby="dock-label" data-hero-seq="6">
        <div class="dock-form">
          <div class="dock-head">
            <p class="dock-label" id="dock-label"><em>FIND BY CATEGORY</em>業種から新宮町の企業をさがす</p>
            <a class="dock-all" href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>">すべての新宮町の企業を見る</a>
          </div>
          <label class="dock-select" for="dock-category">
            <span class="visually-hidden">業種を選ぶ</span>
            <select id="dock-category">
              <option value="">業種を選ぶ</option>
              <option value="飲食">飲食</option>
              <option value="建設">住まい・建設</option>
              <option value="美容">美容</option>
              <option value="健康">健康</option>
              <option value="サービス">サービス</option>
            </select>
          </label>
        </div>
      </section>

      <!-- ============ NEWS TICKER ============ -->
      <section class="newsline" aria-labelledby="newsline-title">
        <h2 id="newsline-title"><em>NEWS</em>お知らせ</h2>
        <div class="newsline-track" id="newsline-track">
          <ul>
            <?php
			$newsline_query = new WP_Query(
				array(
					'post_type'      => 'news',
					'posts_per_page' => 5,
				)
			);
			while ( $newsline_query->have_posts() ) :
				$newsline_query->the_post();
				$link = shingu_shokokai_news_link( get_the_ID() );
				?>
            <li><time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time><a href="<?php echo esc_url( $link['url'] ); ?>"<?php echo $link['external'] ? ' target="_blank" rel="noreferrer"' : ''; ?>><?php the_title(); ?></a></li>
            <?php endwhile; wp_reset_postdata(); ?>
          </ul>
        </div>
        <a class="newsline-more" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">すべて見る</a>
      </section>

      <!-- ============ MARQUEE ============ -->
      <div class="marquee" aria-hidden="true">
        <div class="marquee-track">
          <span>新宮町商工会<i>●</i>まちの仕事と暮らし<i>●</i>読む、探す、相談する<i>●</i></span
          ><span>新宮町商工会<i>●</i>まちの仕事と暮らし<i>●</i>読む、探す、相談する<i>●</i></span>
        </div>
      </div>

      <!-- ============ DIRECTORY ============ -->
      <section id="businesses" class="directory" aria-labelledby="directory-title">
        <div class="directory-intro">
          <p class="section-eyebrow" data-reveal><em>BUSINESS DIRECTORY</em>新宮町の企業</p>
          <h2 id="directory-title" data-reveal>新宮町の会社を探す</h2>
          <p class="directory-count" data-reveal>
            <strong id="directory-count-num" data-count="0">0</strong>
            <span>このサイトに掲載中の企業</span>
          </p>
          <p data-reveal>飲食、住まい、美容、健康、サービスなど、必要な内容から町内の新宮町の企業を探せます。業種で絞り込み、気になるお店や会社の基本情報を確認できます。</p>
          <a class="button-primary" href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>" data-reveal><span>事業者一覧を見る</span></a>
        </div>
        <div id="business-preview-list" class="directory-preview"></div>
      </section>

      <!-- ============ MEMBER LOGOS（加盟企業） ============ -->
      <section class="members" aria-labelledby="members-title">
        <div class="members-head" data-reveal>
          <p class="section-eyebrow"><em>MEMBER COMPANIES</em>加盟企業</p>
          <h2 id="members-title">まちを支える、加盟企業のみなさん</h2>
          <p class="members-note">新宮町商工会には、さまざまな業種の事業者が加盟しています。<small>※ ロゴは掲載イメージです</small></p>
        </div>
        <div class="members-marquee" aria-label="加盟企業ロゴ（1列目）">
          <div class="members-track" id="members-track-a" aria-hidden="true"></div>
        </div>
        <div class="members-marquee" aria-label="加盟企業ロゴ（2列目）">
          <div class="members-track reverse" id="members-track-b" aria-hidden="true"></div>
        </div>
      </section>
      <!-- ============ ABOUT ============ -->
      <section id="about" class="about" aria-labelledby="about-title">
        <div class="about-lead">
          <p class="section-eyebrow" data-reveal><em>ABOUT SHOKOKAI</em>新宮町商工会について</p>
          <h2 id="about-title" data-reveal>商工会を、もっと<br />身近な相談先へ。</h2>
          <p data-reveal>
            新宮町商工会は、昭和36年6月に設立された地域の商工業者を支える団体です。経営改善、創業・経営革新、専門家派遣、まちづくり事業などを通じて、新宮町の仕事と暮らしを支えています。
          </p>
          <div class="about-stats" data-reveal>
            <div><strong data-count="1961">0</strong><span>昭和36年（1961年）設立</span></div>
            <div><strong data-count="640">0</strong><span>会員事業者数</span></div>
            <div><strong data-count="65">0</strong><span>地域とともに歩んだ年数</span></div>
          </div>
        </div>
        <div class="about-grid">
          <article data-reveal>
            <h3>事業者を支える</h3>
            <p>経営、創業、補助金、販路、PRなど、地域で事業を続けるための相談を受けています。</p>
          </article>
          <article data-reveal>
            <h3>地域とつなぐ</h3>
            <p>地元のお店や会社を知るきっかけを増やし、まちの中で買う・頼む・出会う流れを育てます。</p>
          </article>
          <article data-reveal>
            <h3>まちの魅力を発信する</h3>
            <p>地域産業おこしや広報活動を通じて、新宮町の仕事、商品、人の魅力を紹介します。</p>
          </article>
        </div>
        <div class="about-links" data-reveal aria-label="商工会について調べる">
          <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について</a>
          <a href="<?php echo esc_url( home_url( '/yakuin/' ) ); ?>">役員紹介</a>
          <a href="<?php echo esc_url( home_url( '/shien/' ) ); ?>">支援メニュー</a>
          <a href="<?php echo esc_url( home_url( '/kaikan/' ) ); ?>">会館使用</a>
          <a href="<?php echo esc_url( home_url( '/gaiyo/' ) ); ?>">概要・アクセス</a>
          <a href="<?php echo esc_url( home_url( '/nyukai/' ) ); ?>">入会について</a>
        </div>
      </section>

      <!-- ============ NEWS ============ -->
      <section id="news" class="news" aria-labelledby="news-title">
        <div class="section-heading" data-reveal>
          <div>
            <p class="section-eyebrow"><em>NEWS</em>お知らせ</p>
            <h2 id="news-title">商工会からのお知らせ</h2>
          </div>
        </div>
        <div class="news-list">
          <?php
			$home_news_query = new WP_Query(
				array(
					'post_type'      => 'news',
					'posts_per_page' => 3,
				)
			);
			while ( $home_news_query->have_posts() ) :
				$home_news_query->the_post();
				$link  = shingu_shokokai_news_link( get_the_ID() );
				$terms = get_the_terms( get_the_ID(), 'news_tag' );
				$tag   = ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ) ? $terms[0]->name : '';
				?>
          <a href="<?php echo esc_url( $link['url'] ); ?>"<?php echo $link['external'] ? ' target="_blank" rel="noreferrer"' : ''; ?> data-reveal>
            <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
            <?php if ( $tag ) : ?><span class="news-tag"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
            <h3><?php the_title(); ?></h3>
          </a>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="news-more" data-reveal>
          <a class="button-ghost" href="<?php echo esc_url( home_url( '/news/' ) ); ?>"><span>すべてのお知らせを見る</span></a>
        </div>
      </section>

      <!-- ============ CONTACT / APPLY ============ -->
      <section id="contact" class="contact" aria-labelledby="contact-title">
        <div class="contact-info">
          <p class="section-eyebrow" data-reveal><em>ACCESS / CONTACT</em>相談窓口</p>
          <h2 id="contact-title" data-reveal>相談・問い合わせ窓口</h2>
          <p data-reveal>経営相談、創業準備、お店・会社のPRや掲載、商工会への入会まで。新宮町商工会がまとめて相談を受け付けます。まずはお気軽にご相談ください。</p>
          <dl class="contact-list" data-reveal>
            <div><dt>団体名</dt><dd>新宮町商工会</dd></div>
            <div><dt>所在地</dt><dd>〒811-0112 福岡県糟屋郡新宮町下府3-17-1</dd></div>
            <div><dt>電話</dt><dd><a href="tel:0929634567">092-963-4567</a></dd></div>
            <div><dt>FAX</dt><dd>092-962-4355</dd></div>
            <div><dt>メール</dt><dd><a href="mailto:shingu@shokokai.ne.jp">shingu@shokokai.ne.jp</a></dd></div>
            <div><dt>設立</dt><dd>昭和36年6月</dd></div>
            <div><dt>会員数</dt><dd>640</dd></div>
          </dl>
          <div class="contact-actions" data-reveal>
            <a class="button-ghost" href="<?php echo esc_url( home_url( '/gaiyo/' ) ); ?>"><span>アクセスを見る</span></a>
            <a class="button-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>専用ページで相談する</span></a>
          </div>
        </div>

        <aside class="contact-form-panel" data-reveal>
          <p class="section-eyebrow"><em>QUICK FORM</em>かんたん相談フォーム</p>
          <form class="contact-form" id="home-contact-form" novalidate>
            <label for="hcf-name">
              <span class="label-text">お名前 <em class="req" aria-hidden="true">必須</em></span>
              <input type="text" id="hcf-name" name="name" required autocomplete="name" placeholder="例）新宮 太郎" />
            </label>
            <label for="hcf-company">
              事業者名・屋号（任意）
              <input type="text" id="hcf-company" name="company" autocomplete="organization" placeholder="例）しんぐうベーカリー" />
            </label>
            <label for="hcf-contact">
              <span class="label-text">ご連絡先（メールまたは電話） <em class="req" aria-hidden="true">必須</em></span>
              <input type="text" id="hcf-contact" name="contact" required placeholder="例）info@example.com / 092-000-0000" />
            </label>
            <fieldset class="cf-types" id="hcf-types">
              <legend>相談の種類 <span class="hint">（複数選択可）</span></legend>
              <label class="cf-check"><input type="checkbox" name="type" value="経営相談" /><span>経営相談（資金繰り・販路など）</span></label>
              <label class="cf-check"><input type="checkbox" name="type" value="創業" /><span>創業・開業の相談</span></label>
              <label class="cf-check"><input type="checkbox" name="type" value="pr" /><span>お店・会社の掲載やPR</span></label>
              <label class="cf-check"><input type="checkbox" name="type" value="入会" /><span>商工会への入会</span></label>
              <label class="cf-check"><input type="checkbox" name="type" value="その他" /><span>その他</span></label>
            </fieldset>
            <label for="hcf-body">
              <span class="label-text">ご相談内容 <em class="req" aria-hidden="true">必須</em></span>
              <textarea id="hcf-body" name="body" required placeholder="いま困っていること、相談したいことをご記入ください。"></textarea>
            </label>
            <p class="contact-note">※ これはデモ画面です。送信ボタンを押しても実際には送信されません。</p>
            <button class="button primary contact-submit" type="submit"><span>この内容で相談する</span></button>
          </form>
          <div class="form-done" id="home-form-done" hidden>
            <p class="fd-mark" aria-hidden="true">✓</p>
            <h3>ご相談を受け付けました（デモ）</h3>
            <p>本番環境では、ここで受付完了メールが届き、担当者から2営業日以内にご連絡します。</p>
          </div>
        </aside>
      </section>
    </main>

<?php get_footer(); ?>
