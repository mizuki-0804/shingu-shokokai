    <footer class="site-footer">
      <div class="footer-giant" aria-hidden="true"><span>SHINGUMACHI SHOKOKAI</span></div>
      <div class="footer-inner">
        <div>
          <p class="footer-brand"><span class="brand-mark">新</span>新宮町商工会｜まちの仕事と暮らし</p>
          <p class="footer-note">新宮町のお店・会社・人をつなぐ商工会です</p>
        </div>
        <nav class="footer-nav" aria-label="フッターナビゲーション">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a>
          <a href="<?php echo esc_url( home_url( '/businesses/' ) ); ?>">新宮町の企業一覧</a>
          <a href="<?php echo esc_url( home_url( '/nyukai/' ) ); ?>">入会案内</a>
          <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">商工会について</a>
          <a href="<?php echo esc_url( is_front_page() ? '#contact' : home_url( '/#contact' ) ); ?>">相談窓口</a>
        </nav>
      </div>
      <p class="footer-copy">© <?php echo esc_html( gmdate( 'Y' ) ); ?> 新宮町商工会</p>
    </footer>

    <?php if ( ! is_front_page() && ! is_singular( 'post' ) && ! is_singular( 'business' ) && ! is_page_template( 'template-articles.php' ) && ! is_page_template( 'template-businesses.php' ) ) : ?>
    <script>
      // モバイルメニュー（記事系ページは article.js が同じ処理を持っているため、二重登録を避ける）
      (function () {
        var t = document.getElementById("menu-toggle");
        var m = document.getElementById("mobile-menu");
        if (!t || !m) return;
        function close() {
          t.setAttribute("aria-expanded", "false");
          m.classList.remove("is-open");
          document.body.classList.remove("is-locked");
          setTimeout(function () { m.setAttribute("hidden", ""); }, 400);
        }
        t.addEventListener("click", function () {
          if (t.getAttribute("aria-expanded") === "true") { close(); return; }
          m.removeAttribute("hidden");
          requestAnimationFrame(function () { m.classList.add("is-open"); });
          t.setAttribute("aria-expanded", "true");
          document.body.classList.add("is-locked");
        });
        Array.prototype.forEach.call(m.querySelectorAll("a"), function (a) {
          a.addEventListener("click", close);
        });
      })();
    </script>
    <?php endif; ?>

    <?php wp_footer(); ?>
  </body>
</html>
