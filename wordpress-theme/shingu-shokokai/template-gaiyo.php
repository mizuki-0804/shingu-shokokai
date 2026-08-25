<?php
/**
 * Template Name: 概要・アクセス
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 */
get_header();
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について</a><span>/</span>
        <b>概要・アクセス</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">Profile</p>
        <h1>概要・アクセス</h1>
        <p class="dir-lead">新宮町商工会の組織概要と、商工会館までのアクセスをご案内します。</p>
      </section>

      <section class="section businesses-section" aria-label="商工会概要">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Organization</p>
            <h2>商工会概要</h2>
          </div>
        </div>

        <dl class="info-list">
          <div><dt>名称</dt><dd>新宮町商工会</dd></div>
          <div><dt>設立年月日</dt><dd>昭和36年6月</dd></div>
          <div><dt>所在地</dt><dd>〒811-0112 福岡県糟屋郡新宮町下府3-17-1</dd></div>
          <div><dt>会員数</dt><dd>640</dd></div>
          <div><dt>役員数</dt><dd>会長（1名）、副会長（2名）、理事（18名）、監事（2名）</dd></div>
          <div><dt>職員数</dt><dd>事務局長（1名）、経営指導員（2名）、経営支援員（3名）</dd></div>
          <div><dt>関係団体</dt><dd>全国商工会連合会、福岡県商工会連合会、福岡県下商工会</dd></div>
          <div>
            <dt>事業内容</dt>
            <dd>
              経営支援事業（経営改善普及事業、創業・経営革新支援事業、経営課題を解決する提案型経営支援事業、専門家派遣）<br />
              まちづくり事業（地域づくりへの提言活動、行政等との連携強化、「産業」「地域」の視点での考察）
            </dd>
          </div>
        </dl>
      </section>

      <section class="section businesses-section" aria-label="アクセス">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Access</p>
            <h2>アクセス</h2>
          </div>
        </div>

        <dl class="info-list">
          <div><dt>所在地</dt><dd>〒811-0112 福岡県糟屋郡新宮町下府3-17-1</dd></div>
          <div><dt>電話</dt><dd><a href="tel:0929634567">092-963-4567</a></dd></div>
          <div><dt>FAX</dt><dd>092-962-4355</dd></div>
          <div><dt>受付時間</dt><dd>8:30〜17:00（土・日・祝日を除く）</dd></div>
        </dl>

        <div class="access-map">
          <iframe
            title="新宮町商工会館の地図"
            src="https://www.google.com/maps?q=%E7%A6%8F%E5%B2%A1%E7%9C%8C%E7%B3%9F%E5%B1%8B%E9%83%A1%E6%96%B0%E5%AE%AE%E7%94%BA%E4%B8%8B%E5%BA%9C3-17-1&output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
