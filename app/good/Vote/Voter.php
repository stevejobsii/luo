<?php 
namespace App\good\Vote;

use App\Reply;
use Auth;
use App\Topic;
use App\Vote;
use Carbon\Carbon;
use App\User;
use App\Notification;

class Voter
{
    public $notifiedUsers = [];

    public function topicUpVote(Topic $topic)
    {
        if ($topic->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // click twice for remove upvote
            $topic->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $topic->decrement('vote_count', 1);
        } elseif ($topic->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // user already clicked downvote once
            $topic->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $topic->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $topic->increment('vote_count', 2);
        } else {
            // first time click
            $topic->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $topic->increment('vote_count', 1);

            Notification::notify('topic_upvote', Auth::user(), $topic->user, $topic);
        }
    }

    public function topicDownVote(Topic $topic)
    {
        if ($topic->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // click second time for remove downvote
            $topic->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $topic->increment('vote_count', 1);
        } elseif ($topic->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // user already clicked upvote once
            $topic->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $topic->votes()->create(['user_id' => Auth::id(), 'is' => 'downvote']);
            $topic->decrement('vote_count', 2);
        } else {
            // click first time
            $topic->votes()->create(['user_id' => Auth::id(), 'is' => 'downvote']);
            $topic->decrement('vote_count', 1);
        }
    }

    public function replyUpVote(Reply $reply)
    {
        if ($reply->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // click twice for remove upvote
            $reply->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $reply->decrement('vote_count', 1);
        } elseif ($reply->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // user already clicked downvote once
            $reply->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $reply->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $reply->increment('vote_count', 2);
        } else {
            // first time click
            $reply->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $reply->increment('vote_count', 1);

            Notification::notify('reply_upvote', Auth::user(), $reply->user, $reply->topic, $reply);
        }
    }
}
