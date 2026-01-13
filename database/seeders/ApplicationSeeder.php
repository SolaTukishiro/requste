<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applications = [
            [
                'creator_id' => 3,
                'title' => 'YouTubeサムネイルを制作します',
                'status' => 0,
                'description' => '週1〜2枚対応。視認性重視でCTR改善を狙ったデザインにします。',
                'price' => 9000,
            ],
            [
                'creator_id' => 3,
                'title' => 'LP用バナーを3点制作します',
                'status' => 1,
                'description' => 'PC/スマホの2サイズ対応。トンマナを合わせた訴求重視の構成。',
                'price' => 18000,
            ],
            [
                'creator_id' => 3,
                'title' => '名刺デザインを制作します',
                'status' => 0,
                'description' => '両面カラー対応。ロゴや情報をご提供いただければ整えます。',
                'price' => 22000,
            ],
            [
                'creator_id' => 3,
                'title' => 'アイコン用似顔絵イラストを描きます',
                'status' => 1,
                'description' => '1点制作。シンプルで親しみやすいテイストに仕上げます。',
                'price' => 7000,
            ],
            [
                'creator_id' => 3,
                'title' => '資料用の図解を制作します',
                'status' => 0,
                'description' => 'A4縦1枚。文章を元に視覚的に分かりやすく整理します。',
                'price' => 15000,
            ],
            [
                'creator_id' => 4,
                'title' => '商品パッケージのデザイン案を作ります',
                'status' => 1,
                'description' => '食品系に強いです。3案まで提案、既存ロゴ反映可。',
                'price' => 45000,
            ],
            [
                'creator_id' => 4,
                'title' => 'アプリアイコンのデザインを制作します',
                'status' => 0,
                'description' => 'iOS/Android対応。認識性の高いシンプルな形に仕上げます。',
                'price' => 30000,
            ],
            [
                'creator_id' => 4,
                'title' => '店舗チラシのデザインを制作します',
                'status' => 1,
                'description' => 'A4片面。原稿を元に視線誘導を意識したレイアウトにします。',
                'price' => 25000,
            ],
            [
                'creator_id' => 4,
                'title' => '結婚式ムービーの編集を承ります',
                'status' => 1,
                'description' => '素材をご提供ください。BGMとテロップ込みで感動系に編集します。',
                'price' => 50000,
            ],
            [
                'creator_id' => 4,
                'title' => 'SNS投稿用画像を10枚制作します',
                'status' => 0,
                'description' => 'Instagram用。テンプレ化して色違い展開も可能です。',
                'price' => 20000,
            ],
            [
                'creator_id' => 4,
                'title' => 'ロゴのブラッシュアップを行います',
                'status' => 0,
                'description' => '既存ロゴの配色やフォントを調整して洗練させます。',
                'price' => 12000,
            ],
            [
                'creator_id' => 4,
                'title' => 'EC商品画像の撮影・加工をします',
                'status' => 0,
                'description' => '小物中心で8点ほど。白背景で統一し、色味を整えます。',
                'price' => 55000,
            ],
        ];

        foreach ($applications as $application) {
            Application::create($application);
        }
    }
}
