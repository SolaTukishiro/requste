---
title: "Laravel初心者が「認可（Policy）」を理解するまで 〜自作チェック関数から authorize へ〜"
emoji: "🎃"
type: "tech" # tech: 技術記事 / idea: アイデア
topics: ["laravel", "php", "初心者", "認可", "policy"]
published: true
---
## はじめに

前回の記事  
[「Laravelで案件編集の認可をPolicyに切り出して、Controllerをスッキリさせるまでの試行錯誤」](https://zenn.dev/solatukishiro/articles/1fad95c1eb9328)  
では、

「毎回 Controller に認可処理を書くのが大変だったため、  
認可処理を Policy に切り出す」という試みを紹介しました。

その結果、**認可処理を切り出すこと自体には成功**したものの、  
当時の実装では

- 不要な処理が増えてしまった
- Laravelの流儀とは少しズレた書き方になっていた

という課題が残っていました。

この記事では、  
その後に色々と調べた内容や試行錯誤を通して  
**実装をよりシンプルでLaravelらしい形に修正した内容**を  
初学者視点でまとめていきます。

---

## 最初に書いていたコード（一見うまく動いていた）

最初は、Policy にこんなメソッドを書いていました。

```php
public function authClientId(RequestModel $request): bool
{
    $result = true;
    if ($request->client_id === auth()->id()) {
        $result = false;
    }
    return $result;
}
```
Controller 側では、こんな感じです。
```php
$policy = new RequestPolicy();
if ($policy->authClientId($request)) {
    abort(403);
}
```
### 当時の考え

- 自分が作った案件かどうかをチェックしたい
- `client_id` とログインユーザーの `id` を比べる
- ダメなら 403 を返す

発想自体は間違っていませんでした。

### でも、この実装には問題があった

#### ① Laravelの認可機構と繋がっていない
Laravelには、最初から  
「認可（Authorization）」の仕組みが用意されています。

しかしこの実装は、

- Policy を new して
- 独自メソッドを呼び
- if 文で abort(403) する

という、**Laravelの流儀とは違う書き方**でした。  

#### ② auth() に依存している
`auth()->id()`
を Policy の中で直接呼んでいるため、

- テストしづらい
- ロール（admin / client / creator）が増えると破綻しやすい  

という問題もあります。

#### ③ Controller に認可ロジックが残っている

- 判定の一部は Policy
- abort や制御は Controller

という **責務が分散した状態**になっていました。  

---

## Laravelが用意している正解ルート
Laravelでは、
> 「この人がこの操作をしていいか？」

を判断するために、
Policy + authorize を使います。  
Controller では、これだけ書きます。

```php
$this->authorize('update', $request);
```

### `$this->authorize()` は何をしているのか？

一見すると、  
> 引数が2つしかないのに、どこで判定しているの？  

と思いました。

実は **Laravel が裏で全部やってくれています。**  

#### Laravelが裏でやっていること
```php
$this->authorize('update', $request);
```

この1行で、Laravelは内部的に次のことを行います。

1. `$request` の型を見る（RequestModel）
2. 対応する Policy（RequestPolicy）を探す
3. `update` メソッドを探す
4. ログイン中の User を自動で取得
5. Policy をこう呼ぶ

```php
RequestPolicy::update($user, $request);
```

これは Controller から直接呼んでいるわけではなく、  
Laravel が内部で自動的に呼び出しています。

---
## 修正後の Policy（正しい形）
```php
class RequestPolicy
{
    public function update(User $user, RequestModel $request): bool
    {
        return $request->client_id === $user->id;
    }
}
```

ポイント

- auth() は使わない
- if / abort / redirect は書かない
- true / false を返すだけ

## Controller 側（最終形）
```php
public function edit(RequestModel $request)
{
    $this->authorize('update', $request);

    return view('client.requests.edit', compact('request'));
}
```
```php
public function update(RequestModel $requestModel, Request $request)
{
    $this->authorize('update', $requestModel);

    $requestModel->update([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
        'price' => $request->price,
    ]);

    return redirect()->route('client.requests.index');
}
```

### URL直叩きも防げる
例えば、

- クライアント1の案件詳細URLを
- クライアント2でログインして直接叩く

と、次のようになります。
```md
THIS ACTION IS UNAUTHORIZED.
```

これは **バグではなく、正しい挙動**です。  

### try-catch は書かない

authorize() は、認可に失敗すると例外を投げます。

しかしそれは Laravel が自動で処理し、  
**403 を返すところまで面倒を見てくれる**ため、

try-catch は不要と判断しました。

## 今回の学びまとめ

- 自作チェック関数は「考え方は正しい」
- でも Laravel には 公式の認可ルートがある
- Controller は「聞くだけ」
- Policy は「判断するだけ」
- User は Laravel が自動で渡す

## おわりに

今回は、自作のチェック関数から始めて、  
Laravel 標準の **Policy + authorize** に書き直すまでの過程をまとめました。

「とりあえず動く」実装から一歩進んで、  
**Laravel が想定している書き方に合わせることで、コードが自然とシンプルになる**  
という点を学べたと思います。

同じように Policy や認可周りでつまずいている方の参考になれば嬉しいです。

初学者が調べながらまとめた内容のため、  
もし誤りやより良い書き方があればご教授いただけると嬉しいです。

最後まで読んでいただき、ありがとうございました。


