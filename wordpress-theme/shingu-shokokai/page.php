<?php
/**
 * 固定ページ用の簡易テンプレート。
 * 役員紹介・支援メニューなどの専用デザインは、この検証の次のステップで
 * それぞれ専用テンプレート（page-yakuin.php 等）に作り込みます。
 */
get_header();
?>
    <main id="top" class="subpage">
      <nav class="breadcrumb" aria-label="パンくず">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><span>/</span>
        <b><?php the_title(); ?></b>
      </nav>

      <section class="dir-hero">
        <h1><?php the_title(); ?></h1>
      </section>

      <section class="section businesses-section">
        <?php
        while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
      </section>
    </main>
<?php get_footer(); ?>
