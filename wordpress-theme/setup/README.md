# WordPress側の中身をそろえる手順

静的サイト（`prototype/`）の内容を、WordPress（Localの `shingu` サイト）に反映するときの手順。

## 1. テーマを入れ替える

```
rsync -a --delete wordpress-theme/shingu-shokokai/ ~/Local\ Sites/shingu/app/public/wp-content/themes/shingu-shokokai/
```

## 2. 掲載企業のプラン・お知らせをそろえる

`businesses-plan.json` は `prototype/data.js` から書き出したもの。作り直すときは:

```
node -e 'global.window={};require("./prototype/data.js");require("fs").writeFileSync("wordpress-theme/setup/businesses-plan.json",JSON.stringify(window.SHINGU_DATA.businesses.map(b=>({id:b.id,name:b.name,plan:b.plan,planRank:b.planRank,website:b.website||""})),null,2))'
```

反映は wp-cli で（Localに同梱のPHPとwp-cliを使う。MySQLのソケットはサイトごとに違う）:

```
SITE="$HOME/Local Sites/shingu/app/public"
PHP=/Applications/Local.app/Contents/Resources/extraResources/lightning-services/php-8.2.29+0/bin/darwin-arm64/bin/php
WP=/Applications/Local.app/Contents/Resources/extraResources/bin/wp-cli/wp-cli.phar
SOCK="$HOME/Library/Application Support/Local/run/ZxFhucv1I/mysql/mysqld.sock"
export SHINGU_PLAN_JSON="$PWD/wordpress-theme/setup/businesses-plan.json"
"$PHP" -d mysqli.default_socket="$SOCK" "$WP" --path="$SITE" eval-file wordpress-theme/setup/sync-shingu.php
```

サイトIDは `~/Library/Application Support/Local/sites.json` で確認できる。
Localでサイトが止まっていると `http://shingu.local/` は 502 を返すので、先にLocalアプリで起動しておくこと。
