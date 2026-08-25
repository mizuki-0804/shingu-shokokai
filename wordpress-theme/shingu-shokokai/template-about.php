<?php
/**
 * Template Name: 商工会について（ハブ）
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 */
get_header();
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <b>商工会について</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">About Us</p>
        <h1>商工会について</h1>
        <p class="dir-lead">新宮町商工会は、町内の商工業者の経営支援と地域の活性化を目的として、特別の法律にもとづき設立された団体です。役員体制・支援メニュー・会館の使い方・組織概要とアクセスを、このページからまとめてご覧いただけます。</p>
      </section>

      <section class="section businesses-section" aria-label="商工会について詳しく見る">
        <div class="hub-grid">
          <a class="hub-card" href="<?php echo esc_url( home_url( '/yakuin/' ) ); ?>">
            <p class="hub-card-eyebrow">Our Team</p>
            <h3>役員紹介</h3>
            <p>現在の執行部と、これまで商工会を牽引してきた歴代会長をご紹介します。</p>
            <i class="hub-card-arrow" aria-hidden="true">詳しく見る →</i>
          </a>
          <a class="hub-card" href="<?php echo esc_url( home_url( '/shien/' ) ); ?>">
            <p class="hub-card-eyebrow">Support</p>
            <h3>支援メニュー</h3>
            <p>経営指導、融資のあっせん、共済・保険、創業支援など、会員が受けられる支援を紹介します。</p>
            <i class="hub-card-arrow" aria-hidden="true">詳しく見る →</i>
          </a>
          <a class="hub-card" href="<?php echo esc_url( home_url( '/kaikan/' ) ); ?>">
            <p class="hub-card-eyebrow">Facility</p>
            <h3>会館使用</h3>
            <p>商工会館の会議室・研修室を、会員・会員外を問わず有料でご利用いただけます。</p>
            <i class="hub-card-arrow" aria-hidden="true">詳しく見る →</i>
          </a>
          <a class="hub-card" href="<?php echo esc_url( home_url( '/gaiyo/' ) ); ?>">
            <p class="hub-card-eyebrow">Profile</p>
            <h3>概要・アクセス</h3>
            <p>設立年月日や会員数などの組織概要と、商工会館までのアクセスをご案内します。</p>
            <i class="hub-card-arrow" aria-hidden="true">詳しく見る →</i>
          </a>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
