<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $req, TweetService $tweetService)
    {
        $tweetId = (int) $req ->route('tweetId');
        if(!$tweetService->checkOwnTweet($req->user()->id, $tweetId)){
            throw new AccessDeniedHttpException();
        }
        // $tweet = Tweet::where('id',$tweetId)->firstOrFail();
        // $tweet->delete();
        Tweet::destroy($tweetId); //上の２行分がこの１行の記述で済む
        return redirect()
            ->route('tweet.index')
            ->with('feedback.success',"つぶやきを削除しました");
    }
}
