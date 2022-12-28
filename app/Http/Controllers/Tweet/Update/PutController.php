<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Tweet\UpdateRequest;
use App\Models\Tweet;
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $req, TweetService $tweetService)
    {
        if (!$tweetService->checkOwnTweet($req->user()->id, $req->id())){
            throw new AccessDeniedHttpException();
        }
        $tweet = Tweet::where('id',$req->id())->firstOrFail();
        $tweet -> content = $req -> tweet2();
        $tweet -> save();
        return redirect()
            ->route('tweet.update.index',['tweetId' => $tweet->id])
            ->with('feedback.success',"つぶやきを編集しました");
    }
}
