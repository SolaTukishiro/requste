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
            [
                'client_id' => 1,
                'title' => 'スプレッドシートの自動化をお願いしたいです',
                'status' => 1,
                'description' => '日報を自動集計して週次レポートを作る仕組みが欲しいです。',
                'price' => 40000,
            ],
            [
                'client_id' => 1,
                'title' => '飲食店のメニュー表を刷新したいです',
                'status' => 0,
                'description' => 'A3二つ折り。写真と価格は支給します。',
                'price' => 28000,
            ],
            [
                'client_id' => 1,
                'title' => 'WordPressのトップページを改修してほしいです',
                'status' => 1,
                'description' => '既存テーマの範囲で構いません。CTAの改善が目的です。',
                'price' => 65000,
            ],
            [
                'client_id' => 1,
                'title' => '補助金申請用の事業計画書を整えてほしいです',
                'status' => 0,
                'description' => '内容は草案あり。読みやすい構成と表現調整を希望。',
                'price' => 50000,
            ],
            [
                'client_id' => 2,
                'title' => 'オンライン占いの鑑定をお願いしたいです',
                'status' => 1,
                'description' => '仕事運と金運中心で、詳細レポート形式希望。',
                'price' => 8000,
            ],
            [
                'client_id' => 2,
                'title' => '営業資料のパワポを作成してほしいです',
                'status' => 0,
                'description' => '10〜12枚程度。既存の原稿とグラフデータあり。',
                'price' => 35000,
            ],
            [
                'client_id' => 2,
                'title' => 'キャリアコーチングを月2回お願いしたいです',
                'status' => 1,
                'description' => '転職準備の自己分析と職務経歴書の添削も希望。',
                'price' => 60000,
            ],
            [
                'client_id' => 2,
                'title' => 'ECサイトのカスタマー対応テンプレを作ってほしいです',
                'status' => 0,
                'description' => '返品・交換・配送遅延など10パターン想定です。',
                'price' => 18000,
            ],
            [
                'client_id' => 1,
                'title' => '社内向けの勤怠管理ツールを簡易で作ってほしいです',
                'status' => 1,
                'description' => 'Webで打刻、CSV出力できれば十分。ログイン機能あり。',
                'price' => 120000,
            ],
            [
                'client_id' => 1,
                'title' => 'YouTube字幕の文字起こしをお願いしたいです',
                'status' => 0,
                'description' => '30分動画を2本。タイムコード入りで納品希望。',
                'price' => 16000,
            ],
            [
                'client_id' => 1,
                'title' => '住宅ローン比較の記事を監修してほしいです',
                'status' => 1,
                'description' => '草稿あり。ファクトチェックと表現修正を希望。',
                'price' => 30000,
            ],
            [
                'client_id' => 1,
                'title' => 'イベント用の横断幕デザインをお願いしたいです',
                'status' => 0,
                'description' => '横3m。ロゴとキャッチコピーはこちらで用意します。',
                'price' => 25000,
            ],
            [
                'client_id' => 2,
                'title' => 'システムのエラー調査と原因特定をお願いしたいです',
                'status' => 1,
                'description' => 'PHPで稼働中の予約サイト。ログは共有可能です。',
                'price' => 70000,
            ],
            [
                'client_id' => 2,
                'title' => '英語のプレゼン資料を日本語に翻訳してほしいです',
                'status' => 0,
                'description' => '全20枚。専門用語はリスト共有します。',
                'price' => 24000,
            ],
            [
                'client_id' => 2,
                'title' => 'オンライン講座のスライドデザインを整えてほしいです',
                'status' => 1,
                'description' => '60枚ほど。フォント・配色・余白の統一が目的。',
                'price' => 80000,
            ],
            [
                'client_id' => 2,
                'title' => '新商品のネーミング案を10個考えてほしいです',
                'status' => 0,
                'description' => '美容系のサプリ。ターゲットは30代女性。',
                'price' => 12000,
            ],
            [
                'client_id' => 1,
                'title' => 'Shopifyの配送設定と送料ルールを整備したいです',
                'status' => 1,
                'description' => '地域別の送料設定と送料無料条件の追加が目的です。',
                'price' => 35000,
            ],
            [
                'client_id' => 1,
                'title' => 'BtoB向けのメール営業文を作成してほしいです',
                'status' => 0,
                'description' => '初回送付用のテンプレ3種。業種はITです。',
                'price' => 15000,
            ],
            [
                'client_id' => 2,
                'title' => 'SNS広告の運用レポートを月次で作ってほしいです',
                'status' => 1,
                'description' => '指標はCPC/CPA/CVR。Google広告中心です。',
                'price' => 45000,
            ],
            [
                'client_id' => 1,
                'title' => '退職代行の利用に関する相談に乗ってほしいです',
                'status' => 0,
                'description' => '初回30分のオンライン相談を希望します。',
                'price' => 5000,
            ],
        ];

        foreach ($requests as $request) {
            Request::create($request);
        }
    }
}
