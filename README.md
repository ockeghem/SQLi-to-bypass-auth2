# SQLインジェクションによる認証回避練習問題（ペッパー対応版）

[SQLインジェクションによる認証回避の練習問題](https://github.com/ockeghem/SQLi-to-bypass-auth)の続編になります。先の問題は、bcryptによるソルト付きハッシュにより保護されたパスワードを使っている場合の認証回避でしたが、こちらは、これらに加えてペッパー(pepper)を使っている場合の認証回避の練習問題です。


# インストール方法
Dockerがインストールしてある環境で、以下でインストール可能です。

```
$ git clone https://github.com/ockeghem/SQLi-to-bypass-auth2.git
$ cd SQLi-to-bypass-auth2
$ docker compose up -d
```

http://localhost:8901/ にアクセスしてください。ログインフォームが表示されます。前回の問題とは異なり、利用者がユーザー登録できます。ログイン後に「マイページ」に遷移して、adminの情報が表示できれば攻撃成功です。ペッパーはコンテナにアタッチすれば参照できますが、それはルール違反とします。ソースコードやテーブル定義は見てもよいことにしますが、「見なくても攻撃できる」方が良い解答とします。
なお、想定攻撃経路は2種類あります。2種類とも解答できれば完答とします。後述のように、sqlmap等のツールは使用可とします。

# sqlmapをバンドルしました
sqlmap等のSQLインジェクション診断ツールを使ってよいレギュレーションとします。sqlmapに親しんでいない参加者の便宜のため、sqlmapコンテナを用意しました。以下でsqlmapを利用することができます。Linux風のプロンプトとなっていますが、Windowsでも同じコマンドで実行可能です。

```
$ docker compose exec sqlmap /bin/bash
...さまざまな表示
# python sqlmap.py -u http://php/
```

上記のように、コンテナ内からターゲットサイトには http://php/ でアクセスできます。sqlmapの詳細についての解説は割愛しますので適当な解説記事をご覧ください。
脆弱性診断用ツールは、自身が管理するサイトあるいは許可を得たサイトにのみ使用ください。これはsqlmapに限らないことですが、sqlmapは許可なく使用すると違法行為になる可能性が特に高いツールですのでご注意ください。

# ライセンス
ソースコードのライセンスはパブリックドメインとします。
