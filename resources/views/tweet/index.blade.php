<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>あああ</title>
</head>
<body>
    <h1>つぶやきアプリ</h1>
    @auth
    <div>
        <p>投稿フォーム</p>
        @if  (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif

        <form action="{{ route('tweet.create') }}" method="post">
            @csrf 
            <label for="tweet-content">つぶやき</label><br>
            <textarea id="tweet-content" type="text" name="aaa" placeholder="つぶやきを入力"></textarea>

            @error('aaa')
            <p style="color: red;">{{ $message }}</p>
            @endError
            
            <br>
            <button type="submit">投稿</button>
            <span>140文字まで</span>
        </form>
    </div>

    <br>

    @endauth
    <div>
        @foreach($tweets as $tweet)
                >>{{ $tweet -> user -> name }}<br>
                {{ $tweet -> content }}

                        @props([
                                'images' => []
                        ])
                        @if(count($images) > 0)
                        <div x-data="{}" class="px-2">
                            <div class="flex justify-center -mx-2">
                                @foreach($images as $image)
                                <div class="w-1/6 px-2 mt-5">
                                    <div class="bg-gray-400">
                                        <a @click="$dispatch('img-model',{ imgModalSrc:
                                        '{{ asset('storage/images/' . $image->name) }}' })"
                                        class="cursor-pointer">
                                            <img alt="{{ $image->name }}" class="object-fit w-full"
                                            src="{{ asset('storage/images/' . $image->name) }}">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @else
                        <br>
                        ■添付された画像はありません
                        <br>
                        @endif

                @if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
                <details>
                <summary>設定</summary>
                    <div>
                        <a href="{{ route('tweet.update.index',['tweetId' => $tweet->id]) }}">編集</a>
                        <form action="{{ route('tweet.delete',['tweetId' => $tweet->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit">削除</button>
                        </form>
                    </div>
                @else
                    編集できません
                    <br>
                @endif
                </details>

                <br>
        @endforeach
    </div>
    </body>
</html>