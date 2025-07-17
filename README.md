# PHP Sample Code for Amazon Bedrock

Amazon Bedrock を使用した PHP のサンプルコードプロジェクトです。

## セットアップ

### 前提条件

- Git
- PHP 7.4 以上
- Composer
- AWS CLI（設定済み）

### Git のインストール（Windows）

Windows への Git のインストール方法については、以下の公式ドキュメントを参照してください：

https://git-scm.com/download/win

### プロジェクトのクローン

```bash
git clone https://github.com/Sugi275/php-samplecode-for-bedrock.git
cd php-samplecode-for-bedrock
```

### 依存関係のインストール

```bash
composer install
```

## Amazon Bedrock の設定

### モデルの有効化

Amazon Bedrock のモデルを使用する前に、AWS コンソールでモデルを有効化する必要があります。
詳細な手順については、以下の AWS ドキュメントを参照してください：

https://docs.aws.amazon.com/bedrock/latest/userguide/model-access.html

### AWS 認証情報の設定

AWS CLI を使用して認証情報を設定してください：

```bash
aws configure
```

## プログラムの実行

### PHPプログラムの実行方法

```bash
使用法: php product_search.php 商品名
```

```bash
php product_search.php にがうり
```

## ファイル構成

- `product_search.php` - Amazon Bedrock を使用した商品検索のサンプル
- `composer.json` - プロジェクトの依存関係定義
- `.gitignore` - Git で無視するファイルの設定

## 注意事項

- Amazon Bedrock の使用には AWS アカウントが必要です
- 使用するモデルによって料金が発生します
- 環境変数や設定ファイルに認証情報を直接記載しないでください