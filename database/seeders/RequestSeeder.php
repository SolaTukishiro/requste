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
                'title' => 'あなたのアイコン描かせてください！',
                'status' => 1,
                'description' => 'あなたのアイコンを描かせてください！デフォルメキャラ得意です！',
                'price' => 10000,
            ],
            [
                'client_id' => 1,
                'title' => '動画編集なんでもします！',
                'status' => 1,
                'description' => 'おもしろ系・シリアス・ニュース・系なんでも行けます！',
                'price' => 30000,
            ],
            [
                'client_id' => 1,
                'title' => 'VTモデル作れます！',
                'status' => 1,
                'description' => 'デフォルメを生かしたVTモデル作れます！',
                'price' => 200000,
            ],
            [
                'client_id' => 1,
                'title' => '占います！',
                'status' => 1,
                'description' => 'あなたの今後、タロットで調べてみませんか？',
                'price' => 40000,
            ],
            [
                'client_id' => 1,
                'title' => '猫探します！',
                'status' => 1,
                'description' => '夜の猫探し！任せてください！',
                'price' => 100000,
            ],
            [
                'client_id' => 1,
                'title' => 'かっこいいサイン作ります',
                'status' => 0,
                'description' => 'オリジナルのサイン作りませんか？',
                'price' => 40000,
            ],
        ];

        foreach ($requests as $request) {
            Request::create($request);
        }
    }
}
