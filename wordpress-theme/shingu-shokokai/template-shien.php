<?php
/**
 * Template Name: 支援メニュー
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 */
get_header();
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について</a><span>/</span>
        <b>支援メニュー</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">Support Menu</p>
        <h1>支援メニュー</h1>
        <p class="dir-lead">経営の相談・診断から、資金や共済、創業や地域振興まで。新宮町商工会が会員のみなさまにご提供している支援をまとめてご紹介します。</p>
      </section>

      <section class="section businesses-section" aria-label="経営の相談・診断">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Guidance</p>
            <h2>経営の相談・診断</h2>
          </div>
        </div>
        <div class="hub-grid">
          <article class="hub-card">
            <p class="hub-card-eyebrow">経営指導</p>
            <h3>窓口での経営相談</h3>
            <p>経営指導員が経営のお悩みに窓口でアドバイス。企業力アップに向けた経営革新支援も行っています。</p>
          </article>
          <article class="hub-card">
            <p class="hub-card-eyebrow">経営診断</p>
            <h3>無料の経営診断</h3>
            <p>経営指導員が直接お店や会社を訪問し、経営状況を分析。無料で改善点をアドバイスします。</p>
          </article>
          <article class="hub-card">
            <p class="hub-card-eyebrow">エキスパートバンク</p>
            <h3>専門家の派遣</h3>
            <p>専門知識や技術面でお困りの際は、専門家を派遣して適切な指導・助言を行います。</p>
          </article>
        </div>
      </section>

      <section class="section businesses-section" aria-label="資金・実務のサポート">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Finance &amp; Admin</p>
            <h2>資金・実務のサポート</h2>
          </div>
        </div>
        <div class="hub-grid">
          <article class="hub-card">
            <p class="hub-card-eyebrow">マル経資金融資</p>
            <h3>無担保・無保証・低利の融資</h3>
            <p>商工会の推薦により、無担保・無保証・低利で事業資金の融資が受けられる制度をご紹介します。</p>
          </article>
          <article class="hub-card">
            <p class="hub-card-eyebrow">記帳代行</p>
            <h3>記帳のお手伝い</h3>
            <p>所定の用紙に取引をご記入いただくだけで、記帳から経営データの分析までお手伝いします。</p>
          </article>
          <article class="hub-card">
            <p class="hub-card-eyebrow">労働保険の事務代行</p>
            <h3>労働保険手続きの代行</h3>
            <p>従業員を雇用する事業主に義務づけられている労働保険の面倒な事務手続きを代行します。</p>
          </article>
          <article class="hub-card">
            <p class="hub-card-eyebrow">共済・年金・保険</p>
            <h3>各種共済・保険制度</h3>
            <p>小規模企業共済など、安心・有利な各種の共済、年金、保険制度のご相談を承っています。</p>
          </article>
        </div>
      </section>

      <section class="section businesses-section" aria-label="創業・地域振興">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Startup &amp; Community</p>
            <h2>創業・地域振興</h2>
          </div>
        </div>
        <div class="hub-grid">
          <article class="hub-card">
            <p class="hub-card-eyebrow">創業・経営革新支援</p>
            <h3>創業・新分野挑戦の支援</h3>
            <p>創業を予定する方や新たな事業分野に挑む方に、個別相談や創業塾の開催などで支援します。</p>
          </article>
          <article class="hub-card">
            <p class="hub-card-eyebrow">講習会・研修会</p>
            <h3>知識・技術を学ぶ場</h3>
            <p>経営者のみなさまに必要な知識や技術に関する情報を提供する講習会・研修会を開催しています。</p>
          </article>
          <article class="hub-card">
            <p class="hub-card-eyebrow">地域産業おこし</p>
            <h3>特産品づくり・販路開拓</h3>
            <p>地域資源を活かした特産品づくりや販路開拓、新しい観光ルートの開発などを支援します。</p>
          </article>
          <article class="hub-card">
            <p class="hub-card-eyebrow">広報</p>
            <h3>広報誌の発行</h3>
            <p>商工会からのお知らせや会員情報をまとめた広報誌を、年に2回発行しています。</p>
          </article>
        </div>

        <p class="placeholder-note">気になる支援メニューがありましたら、お気軽にご相談ください。内容によってご案内できる制度が異なりますので、まずは窓口までお問い合わせください。</p>
        <a class="button-primary" href="<?php echo esc_url( home_url( '/contact/?type=経営相談' ) ); ?>"><span>支援メニューについて相談する</span></a>
      </section>
    </main>

<?php get_footer(); ?>
