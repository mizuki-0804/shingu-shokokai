<?php
/**
 * 検証用WordPress（shingu.local）に、8/5〜8/6 の変更を反映するスクリプト。
 * wp eval-file で実行する。
 */

echo "== 1. 会員企業の掲載プランを data.js に合わせる ==\n";
$json = file_get_contents( getenv( 'SHINGU_PLAN_JSON' ) );
$plans = json_decode( $json, true );
if ( ! $plans ) {
	echo "  !! プラン一覧のファイルが読めませんでした\n";
} else {
	$updated = 0;
	$missing = array();
	foreach ( $plans as $b ) {
		$post = get_page_by_title( $b['name'], OBJECT, 'business' );
		if ( ! $post ) {
			$missing[] = $b['name'];
			continue;
		}
		$before_rank  = get_post_meta( $post->ID, 'plan_rank', true );
		$before_label = get_post_meta( $post->ID, 'plan_label', true );
		if ( (string) $before_rank !== (string) $b['planRank'] || $before_label !== $b['plan'] ) {
			update_post_meta( $post->ID, 'plan_rank', $b['planRank'] );
			update_post_meta( $post->ID, 'plan_label', $b['plan'] );
			echo "  更新: {$b['name']} : {$before_label}({$before_rank}) -> {$b['plan']}({$b['planRank']})\n";
			++$updated;
		}
	}
	echo "  更新した会員企業: {$updated}社 / 見つからなかった: " . count( $missing ) . "社\n";
	if ( $missing ) {
		echo "  見つからない: " . implode( ', ', array_slice( $missing, 0, 10 ) ) . "\n";
	}
}

echo "== 2. お知らせページ（固定ページ）を用意する ==\n";
$news_page = get_page_by_path( 'news' );
if ( ! $news_page ) {
	$news_page_id = wp_insert_post(
		array(
			'post_title'   => 'お知らせ',
			'post_name'    => 'news',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => '',
		)
	);
	echo "  作成しました（ID {$news_page_id}）\n";
} else {
	$news_page_id = $news_page->ID;
	echo "  すでにあります（ID {$news_page_id}）\n";
}
update_post_meta( $news_page_id, '_wp_page_template', 'template-news.php' );
echo "  テンプレート: template-news.php を設定\n";

echo "== 3. お知らせ3件を登録する ==\n";
$items = array(
	array(
		'title' => '事業承継・M&A補助金 公募説明会のお知らせ',
		'date'  => '2026-06-22 09:00:00',
		'tag'   => '補助金',
		'url'   => 'http://www.shinguumachi.or.jp/archives/1238',
	),
	array(
		'title' => '人権啓発セミナー開催のお知らせ',
		'date'  => '2026-06-19 09:00:00',
		'tag'   => 'セミナー',
		'url'   => 'http://www.shinguumachi.or.jp/archives/1218',
	),
	array(
		'title' => '勤労者知事表彰候補者の推薦について',
		'date'  => '2026-06-08 09:00:00',
		'tag'   => '推薦',
		'url'   => 'http://www.shinguumachi.or.jp/archives/1199',
	),
);
foreach ( $items as $item ) {
	$existing = get_page_by_title( $item['title'], OBJECT, 'news' );
	if ( $existing ) {
		$post_id = $existing->ID;
		echo "  すでにあります: {$item['title']}\n";
	} else {
		$post_id = wp_insert_post(
			array(
				'post_title'    => $item['title'],
				'post_type'     => 'news',
				'post_status'   => 'publish',
				'post_content'  => '',
				// 未来日にすると公開されないため、日付は gmt も同時に指定する
				'post_date'     => $item['date'],
				'post_date_gmt' => get_gmt_from_date( $item['date'] ),
			)
		);
		echo "  作成: {$item['title']}（ID {$post_id}）\n";
	}
	update_post_meta( $post_id, 'external_url', $item['url'] );
	wp_set_object_terms( $post_id, $item['tag'], 'news_tag', false );
}

echo "== 4. パーマリンクを更新 ==\n";
flush_rewrite_rules( false );
echo "  完了\n";
