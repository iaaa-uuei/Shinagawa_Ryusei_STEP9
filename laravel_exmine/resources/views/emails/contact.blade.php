<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせメール</title>
    </head>
    <body>
        <h2>お問い合わせを受信しました</h2>

        <p><strong>名前：</strong>{{ $data['name'] }}</p>
        <p><strong>メールアドレス：</strong>{{ $data['email'] }}</p>
        <p><strong>お問い合わせ内容</strong></p>
        <p>{!! nl2br(e($data['message'])) !!}</p>
    </body>
</html>