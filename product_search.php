<?php

require_once 'vendor/autoload.php';

use Aws\BedrockRuntime\BedrockRuntimeClient;

class ProductSearch 
{
    private $bedrockClient;
    private $products;

    public function __construct()
    {
        $this->bedrockClient = new BedrockRuntimeClient([
            'region' => 'us-east-1',
            'version' => 'latest'
        ]);

        $this->products = [
            'F001' => 'りんご',
            'F002' => 'みかん',
            'F003' => 'バナナ',
            'F004' => 'いちご',
            'F005' => 'ぶどう',
            'F006' => '桃',
            'F007' => '梨',
            'F008' => '柿',
            'F009' => 'キウイ',
            'F010' => 'メロン',
            'F011' => 'スイカ',
            'F012' => 'パイナップル',
            'F013' => 'マンゴー',
            'F014' => 'さくらんぼ',
            'F015' => 'プラム',
            'F016' => 'レモン',
            'F017' => 'グレープフルーツ',
            'F018' => 'オレンジ',
            'F019' => 'ライム',
            'F020' => 'アボカド',
            'V001' => 'キャベツ',
            'V002' => 'レタス',
            'V003' => '白菜',
            'V004' => 'ほうれん草',
            'V005' => '小松菜',
            'V006' => 'チンゲン菜',
            'V007' => '水菜',
            'V008' => '春菊',
            'V009' => 'にんじん',
            'V010' => '大根',
            'V011' => '玉ねぎ',
            'V012' => 'じゃがいも',
            'V013' => 'さつまいも',
            'V014' => '里芋',
            'V015' => '長芋',
            'V016' => 'ごぼう',
            'V017' => 'れんこん',
            'V018' => 'たけのこ',
            'V019' => 'なす',
            'V020' => 'きゅうり',
            'V021' => 'トマト',
            'V022' => 'ピーマン',
            'V023' => 'パプリカ',
            'V024' => 'ズッキーニ',
            'V025' => 'かぼちゃ',
            'V026' => 'ブロッコリー',
            'V027' => 'カリフラワー',
            'V028' => 'アスパラガス',
            'V029' => 'オクラ',
            'V030' => 'いんげん',
            'V031' => 'ゴーヤ'
        ];
    }

    public function findSimilarProduct($inputProduct)
    {
        $productList = '';
        foreach ($this->products as $code => $name) {
            $productList .= "$code: $name\n";
        }

        $prompt = "以下の商品リストから、入力された商品名「{$inputProduct}」に最も近い商品の商品コードを1つだけ返してください。商品コードのみを回答してください。\n\n商品リスト:\n{$productList}";

        try {
            $response = $this->bedrockClient->converse([
                'modelId' => 'us.anthropic.claude-sonnet-4-20250514-v1:0',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            $result = $response['output']['message']['content'][0]['text'];
            return trim($result);
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
            return null;
        }
    }
}

if ($argc < 2) {
    echo "使用法: php product_search.php <商品名>\n";
    echo "例: php product_search.php にがうり\n";
    exit(1);
}

$searchTerm = $argv[1];
$productSearch = new ProductSearch();
$result = $productSearch->findSimilarProduct($searchTerm);

if ($result) {
    echo $result . "\n";
} else {
    echo "商品が見つかりませんでした。\n";
}

?>