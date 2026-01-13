<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requests = [
            [
                'client_id' => 1,
                'title' => 'YouTubeサムネイルを週1でお願いしたいです',
                'status' => 0,
                'description' => '素材はこちらで用意します。シンプルで目立つ構成希望。',
                'price' => 9000,
            ],
            [
                'client_id' => 1,
                'title' => 'LP用のバナーを3点作成してほしいです',
                'status' => 1,
                'description' => 'サイズはPC/スマホの2種。トンマナ合わせ希望。',
                'price' => 18000,
            ],
            [
                'client_id' => 1,
                'title' => '名刺デザインを作成してほしいです',
                'status' => 0,
                'description' => '両面カラー。会社ロゴと情報はあります。',
                'price' => 22000,
            ],
            [
                'client_id' => 1,
                'title' => 'アイコン用の似顔絵イラストをお願いしたいです',
                'status' => 1,
                'description' => '1点、シンプルで親しみやすい雰囲気希望。',
                'price' => 7000,
            ],
            [
                'client_id' => 1,
                'title' => '資料用の図解を作ってほしいです',
                'status' => 0,
                'description' => 'A4縦1枚。文章は用意済み、図解メインで。',
                'price' => 15000,
            ],
            [
                'client_id' => 1,
                'title' => '商品パッケージのデザイン案が欲しいです',
                'status' => 1,
                'description' => '食品系。3案ほど提案希望、既存ロゴあり。',
                'price' => 45000,
            ],
            [
                'client_id' => 1,
                'title' => 'アプリアイコンのデザインを募集します',
                'status' => 0,
                'description' => 'iOS/Android用。認識性の高いシンプルな形希望。',
                'price' => 30000,
            ],
            [
                'client_id' => 2,
                'title' => '店舗チラシのデザインをお願いしたいです',
                'status' => 1,
                'description' => 'A4片面。原稿あり、分かりやすいレイアウト希望。',
                'price' => 25000,
            ],
            [
                'client_id' => 2,
                'title' => '結婚式ムービーの編集をお願いしたいです',
                'status' => 1,
                'description' => '素材は用意済み。BGMとテロップ込みで感動系に。',
                'price' => 50000,
            ],
            [
                'client_id' => 2,
                'title' => 'SNS投稿用の画像を10枚作成してほしいです',
                'status' => 0,
                'description' => 'Instagram用。テンプレ化して色違い希望。',
                'price' => 20000,
            ],
            [
                'client_id' => 2,
                'title' => 'ロゴの修正をお願いしたいです',
                'status' => 0,
                'description' => '既存ロゴの配色とフォント調整のみ。納品済みデータあり。',
                'price' => 12000,
            ],
            [
                'client_id' => 2,
                'title' => 'ECサイトの商品画像を撮影してほしいです',
                'status' => 0,
                'description' => '小物中心で8点ほど。白背景で統一したいです。',
                'price' => 55000,
            ],
        ];

        foreach ($requests as $request) {
            Request::create($request);
        }
    }
}
