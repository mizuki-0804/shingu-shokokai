<?php
/**
 * Template Name: 相談・お問い合わせ
 * 固定ページを作って、このテンプレートを選ぶと使われます。
 */
get_header();
?>

    <main id="top">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <b>相談・お問い合わせ</b>
      </nav>

      <section class="dir-hero">
        <p class="eyebrow">Contact</p>
        <h1>まずは、商工会に相談する。</h1>
        <p class="dir-lead">経営のこと、創業の準備、お店・会社のPRや掲載、商工会への入会まで。新宮町商工会がまとめて相談を受け付ける窓口です。内容が固まっていなくても大丈夫です。下のフォームからお気軽にご相談ください。</p>
      </section>

      <section class="section businesses-section" aria-labelledby="contact-form-title">
        <div class="section-heading split-heading">
          <div>
            <p class="eyebrow">Form</p>
            <h2 id="contact-form-title">相談内容を送る</h2>
          </div>
          <p>2営業日以内を目安に、担当者からご連絡します。</p>
        </div>

        <form class="contact-form" id="contact-form" novalidate>
          <label for="cf-name">
            <span class="label-text">お名前 <em class="req" aria-hidden="true">必須</em></span>
            <input type="text" id="cf-name" name="name" required autocomplete="name" placeholder="例）新宮 太郎" />
          </label>
          <label for="cf-company">
            事業者名・屋号（任意）
            <input type="text" id="cf-company" name="company" autocomplete="organization" placeholder="例）しんぐうベーカリー" />
          </label>
          <label for="cf-contact">
            <span class="label-text">ご連絡先（メールまたは電話） <em class="req" aria-hidden="true">必須</em></span>
            <input type="text" id="cf-contact" name="contact" required placeholder="例）info@example.com / 092-000-0000" />
          </label>
          <fieldset class="cf-types" id="cf-types">
            <legend>相談の種類 <span class="hint">（複数選択可）</span></legend>
            <label class="cf-check"><input type="checkbox" name="type" value="経営相談" /><span>経営相談（資金繰り・販路など）</span></label>
            <label class="cf-check"><input type="checkbox" name="type" value="創業" /><span>創業・開業の相談</span></label>
            <label class="cf-check"><input type="checkbox" name="type" value="pr" /><span>お店・会社の掲載やPR</span></label>
            <label class="cf-check"><input type="checkbox" name="type" value="入会" /><span>商工会への入会</span></label>
            <label class="cf-check"><input type="checkbox" name="type" value="その他" /><span>その他</span></label>
          </fieldset>
          <label for="cf-body">
            <span class="label-text">ご相談内容 <em class="req" aria-hidden="true">必須</em></span>
            <textarea id="cf-body" name="body" required placeholder="いま困っていること、相談したいことをご記入ください。"></textarea>
          </label>
          <p class="contact-note">※ これはデモ画面です。送信ボタンを押しても実際には送信されません。</p>
          <button class="button primary contact-submit" type="submit"><span>この内容で相談する</span></button>
        </form>

        <div class="form-done" id="form-done" hidden>
          <p class="fd-mark" aria-hidden="true">✓</p>
          <h3>ご相談を受け付けました（デモ）</h3>
          <p>本番環境では、ここで受付完了メールが届き、担当者から2営業日以内にご連絡します。</p>
          <a class="button primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>トップへ戻る</span></a>
        </div>

        <div class="contact-alt">
          <p>お急ぎの場合は、お電話でもご相談いただけます。</p>
          <p class="contact-alt-tel"><a href="tel:0929634567">092-963-4567</a><span>（新宮町商工会・平日 9:00-17:00）</span></p>
        </div>
      </section>
    </main>

    <script>
      // 相談フォーム（デモ送信）。モバイルメニューの開閉は footer.php 側の共通スクリプトが担当。
      (function () {
        "use strict";

        var form = document.getElementById("contact-form");
        var done = document.getElementById("form-done");

        // ?type=経営相談 等で相談の種類を初期チェック（カンマ区切りで複数指定も可）
        var params = (new URLSearchParams(location.search).get("type") || "").split(",").filter(Boolean);
        var typeFieldset = document.getElementById("cf-types");
        params.forEach(function (v) {
          var box = typeFieldset.querySelector('input[value="' + v + '"]');
          if (box) box.checked = true;
        });

        form.addEventListener("submit", function (e) {
          e.preventDefault();
          if (!form.reportValidity()) return;
          form.hidden = true;
          done.hidden = false;
          done.scrollIntoView({ block: "center", behavior: "smooth" });
        });
      })();
    </script>

<?php get_footer(); ?>
