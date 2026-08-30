<?php
/**
 * Template Name: 入会案内
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 */
get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <b>会員の入会について</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">For New Members</p>
        <h1>会員の入会について</h1>
        <p class="dir-lead">新宮町商工会は、中小企業の経営者や個人事業主の皆さまのベストパートナーです。会員ならではのサービスと、地域とのつながりをご案内します。</p>
      </section>

      <section class="section businesses-section" aria-label="入会案内の詳細">
      <div class="article-body">
        <h2>会員のメリット</h2>
        <p>商工会は、中小企業の経営者や個人事業主の皆様のベストパートナーとして、会員ならではのサービスを提供しております。中小企業施策に精通した経営指導員等が、制度融資や政府系金融機関への窓口といった金融斡旋、税務相談、記帳代行、労働保険事務代行等の他、IT活用、経営改善、経営コンサルティング等も実施しております。また、地域の中小企業に共通する経営課題を解決するため、専門家を新宮町に招聘しセミナー等も開催しており、これらは割安な会員料金が適用されます。</p>

        <h2>入会資格</h2>
        <p>新宮町商工会の地区内において引き続き6ヶ月以上営業所、事務所、工場又は事業場を有する商工業者であれば、入会いただけます。</p>
        <p>そのほか、商工会の趣旨に賛同される方は商工業者でなくても、特別会員となることができます。</p>
        <p>※医師、医療法人、社会福祉法人等も入会可能です。</p>

        <h2>会費</h2>
        <dl class="contact-list">
          <div><dt>加入金</dt><dd>入会時のみ 5,000円</dd></div>
          <div><dt>年会費</dt><dd>所在地や事業所規模により異なります。お尋ねください。</dd></div>
        </dl>

        <h2>入会手続き</h2>
        <p>加入申込書に必要事項を記入の上、事務局にご提出ください。理事会の承認の後、正式に商工会会員として手続きが終了します。</p>

        <div class="download-card">
          <div class="download-card-body">
            <p class="download-card-eyebrow">Application Form</p>
            <h3>加入申込書をダウンロード</h3>
            <p>PDF形式です。印刷してご記入のうえ、事務局までご提出ください。</p>
          </div>
          <a class="button primary download-card-btn" href="<?php echo esc_url( $theme_uri . '/assets/files/nyukai-moushikomisho.pdf' ); ?>" download="新宮町商工会_加入申込書.pdf">
            <span>PDFをダウンロード</span><i aria-hidden="true">↓</i>
          </a>
        </div>

        <p>入会についてご不明な点があれば、お気軽に商工会までご相談ください。</p>

        <div class="contact-actions">
          <a class="button-primary" href="<?php echo esc_url( home_url( '/contact/?type=入会' ) ); ?>"><span>入会について相談する</span></a>
          <a class="button-ghost" href="tel:0929634567"><span>092-963-4567 に電話する</span></a>
        </div>
      </div>
      </section>
    </main>

<?php get_footer(); ?>
