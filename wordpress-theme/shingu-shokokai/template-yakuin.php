<?php
/**
 * Template Name: 役員紹介
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 */
get_header();
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について</a><span>/</span>
        <b>役員紹介</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">Our Organization</p>
        <h1>役員紹介</h1>
        <p class="dir-lead">新宮町商工会の現在の執行部と、これまで牽引してきた歴代会長をご紹介します。</p>
      </section>

      <section class="section businesses-section" aria-label="現在の執行部一覧">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Current Board</p>
            <h2>現在の執行部</h2>
          </div>
        </div>
        <p class="placeholder-note">※ これはデモ画面です。氏名・役職・写真は確認中のダミー表示です。実際の掲載時には商工会よりご提供いただいた情報に差し替えます。</p>

        <div class="chairman-grid">
          <article class="chairman-card">
            <div class="chairman-photo" aria-hidden="true">写真 確認中</div>
            <p class="chairman-gen">会長</p>
            <h3 class="chairman-name">氏名（確認中）</h3>
            <p class="chairman-term">就任：確認中</p>
          </article>
          <article class="chairman-card">
            <div class="chairman-photo" aria-hidden="true">写真 確認中</div>
            <p class="chairman-gen">副会長</p>
            <h3 class="chairman-name">氏名（確認中）</h3>
            <p class="chairman-term">就任：確認中</p>
          </article>
          <article class="chairman-card">
            <div class="chairman-photo" aria-hidden="true">写真 確認中</div>
            <p class="chairman-gen">副会長</p>
            <h3 class="chairman-name">氏名（確認中）</h3>
            <p class="chairman-term">就任：確認中</p>
          </article>
          <article class="chairman-card">
            <div class="chairman-photo" aria-hidden="true">写真 確認中</div>
            <p class="chairman-gen">専務理事</p>
            <h3 class="chairman-name">氏名（確認中）</h3>
            <p class="chairman-term">就任：確認中</p>
          </article>
          <article class="chairman-card">
            <div class="chairman-photo" aria-hidden="true">写真 確認中</div>
            <p class="chairman-gen">監事</p>
            <h3 class="chairman-name">氏名（確認中）</h3>
            <p class="chairman-term">就任：確認中</p>
          </article>
        </div>
      </section>

      <section class="section businesses-section" aria-label="歴代会長一覧">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Our History</p>
            <h2>歴代会長</h2>
          </div>
        </div>
        <p class="placeholder-note">※ これはデモ画面です。氏名・在任期間・写真は確認中のダミー表示です。実際の掲載時には商工会よりご提供いただいた情報に差し替えます。</p>

        <div class="chairman-grid">
          <?php
          $gens = array( '初代', '第2代', '第3代', '第4代', '第5代', '第6代', '第7代', '第8代', '第9代', '第10代（現）' );
          foreach ( $gens as $gen ) :
          ?>
          <article class="chairman-card">
            <div class="chairman-photo" aria-hidden="true">写真 確認中</div>
            <p class="chairman-gen"><?php echo esc_html( $gen ); ?></p>
            <h3 class="chairman-name">氏名（確認中）</h3>
            <p class="chairman-term">在任期間：確認中</p>
          </article>
          <?php endforeach; ?>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
