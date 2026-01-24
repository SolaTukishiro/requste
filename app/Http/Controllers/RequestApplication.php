<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;
use Illuminate\Http\Request;

class RequestApplication extends Controller
{
    public function requestsShow(Request $request){
        // tab: open | closed | all
        $tab = $request->query('tab', 'open');

        $query = RequestModel::query()
            ->with('client')               // 一覧で client->name を使うため
            ->whereNull('deleted_at');     // SoftDeletes 使ってるなら本来不要。保険で書くならこれ。

        if ($tab === 'open') {
            $query->where('status', true);
        } elseif ($tab === 'closed') {
            $query->where('status', false);
        } elseif ($tab === 'all') {
            // 何もしない
        } else {
            // 変な値が来たらデフォルトに戻す
            $tab = 'open';
            $query->where('status', true);
        }

        $requests = $query
            ->latest()
            ->paginate(12)
            ->appends(['tab' => $tab]); // ページ送りでもタブ維持

        return view('creator.requests.index', compact('requests', 'tab'));
    }
}
