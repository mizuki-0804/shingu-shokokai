<?php
/**
 * Template Name: 会館使用
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 * plans.css の .plan-table を料金表に流用しているため、このテンプレートだけ
 * 個別にそのスタイルを読み込みます。
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		$theme_uri = get_stylesheet_directory_uri();
		$ver       = wp_get_theme()->get( 'Version' );
		wp_enqueue_style( 'shingu-plans', $theme_uri . '/assets/plans.css', array( 'shingu-home' ), $ver );
	}
);

get_header();
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について</a><span>/</span>
        <b>会館使用</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">Facility</p>
        <h1>会館使用について</h1>
        <p class="dir-lead">商工会館の会議室・研修室は、会員はもちろん会員外の方にもご利用いただけます。目的・時間帯に応じた利用料金をご案内します。</p>
      </section>

      <section class="section businesses-section" aria-label="会議・研修等の利用料金">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Rates</p>
            <h2>会議・研修等の利用料金</h2>
          </div>
        </div>

        <div class="plan-table-wrap">
          <table class="plan-table">
            <thead>
              <tr>
                <th scope="col">室名</th>
                <th scope="col">利用者</th>
                <th scope="col">9:00〜12:00</th>
                <th scope="col">12:00〜17:00</th>
                <th scope="col">17:00〜22:00</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" rowspan="2">大会議室Ⅰ・Ⅱ</th>
                <td>会員</td>
                <td>1,650円</td>
                <td>2,750円</td>
                <td>3,300円</td>
              </tr>
              <tr>
                <td>会員外</td>
                <td>2,475円</td>
                <td>4,125円</td>
                <td>−</td>
              </tr>
              <tr>
                <th scope="row" rowspan="2">和室Ⅰ・Ⅱ</th>
                <td>会員</td>
                <td>1,650円</td>
                <td>2,750円</td>
                <td>3,300円</td>
              </tr>
              <tr>
                <td>会員外</td>
                <td>2,475円</td>
                <td>4,125円</td>
                <td>−</td>
              </tr>
              <tr>
                <th scope="row" rowspan="2">小会議室</th>
                <td>会員</td>
                <td>1,650円</td>
                <td>2,750円</td>
                <td>−</td>
              </tr>
              <tr>
                <td>会員外</td>
                <td>2,475円</td>
                <td>4,125円</td>
                <td>−</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section class="section businesses-section" aria-label="展示会・物品販売等の利用料金">
        <div class="section-heading">
          <div>
            <p class="eyebrow">Rates</p>
            <h2>展示会・物品販売等の利用料金</h2>
          </div>
          <p>利用時間は9:00〜17:00です。</p>
        </div>

        <div class="plan-table-wrap">
          <table class="plan-table">
            <thead>
              <tr>
                <th scope="col">室名</th>
                <th scope="col">会員</th>
                <th scope="col">会員外</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">大会議室Ⅰ・Ⅱ</th>
                <td>16,500円</td>
                <td>27,500円</td>
              </tr>
              <tr>
                <th scope="row">和室Ⅰ・Ⅱ</th>
                <td>16,500円</td>
                <td>22,000円</td>
              </tr>
              <tr>
                <th scope="row">小会議室</th>
                <td>7,700円</td>
                <td>11,000円</td>
              </tr>
            </tbody>
          </table>
        </div>

        <p class="placeholder-note">※ 大会議室・和室を全室利用する場合は倍額料金となります。午前中からの延長使用は1時間につき550円（会員外は825円）加算されます。17:00以降および土日祝日の会館使用は会員のみとなります。冷暖房設備は有料（コイン式・運転時間制）で1時間200円です。</p>
      </section>

      <section class="section businesses-section" aria-label="使用申込手続き">
        <div class="section-heading">
          <div>
            <p class="eyebrow">How to Apply</p>
            <h2>使用申込手続き</h2>
          </div>
        </div>
        <p>会館使用申込書に必要事項をご記入のうえ、事務局までご提出ください。なお、会館使用は商工会事業等を優先するため、お申込み時点で使用を確約するものではありません。あらかじめご了承ください。</p>

        <p class="placeholder-note">※ これはデモ画面です。会館使用申込書のPDFは準備中です。実際の掲載時には、ダウンロードできるようにします。</p>

        <a class="button-primary" href="<?php echo esc_url( home_url( '/contact/?type=その他' ) ); ?>"><span>会館使用について相談する</span></a>
      </section>
    </main>

<?php get_footer(); ?>
