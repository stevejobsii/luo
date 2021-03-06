<?php namespace App\good\Notification;

use App\good\Notification\Mention;
use App\Reply;
use Auth;
use App\Topic;
use App\Notification;
use Carbon\Carbon;
use App\User;
use App\Append;

//input

class Notifier
{
    public $notifiedUsers = [];

    public function newReplyNotify(User $fromUser, Mention $mentionParser, Topic $topic, Reply $reply)
    {
        // Notify the author
        Notification::batchNotify(
                    'new_reply',
                    $fromUser,
                    $this->removeDuplication([$topic->user]),
                    $topic,
                    $reply);

        // Notify attented users
        Notification::batchNotify(
                    'attention',
                    $fromUser,
                    $this->removeDuplication($topic->attentedBy),
                    $topic,
                    $reply);

        // Notify mentioned users
        Notification::batchNotify(
                    'at',
                    $fromUser,
                    $this->removeDuplication($mentionParser->users),
                    $topic,
                    $reply);
    }

    public function newAppendNotify(User $fromUser, Topic $topic, Append $append)
    {
        $users = $topic->replies()->with('user')->get()->lists('user');

        // Notify commented user
        Notification::batchNotify(
                    'comment_append',
                    $fromUser,
                    $this->removeDuplication($users),
                    $topic,
                    null,
                    $append->content);

        // Notify attented users
        Notification::batchNotify(
                    'attention_append',
                    $fromUser,
                    $this->removeDuplication($topic->attentedBy),
                    $topic,
                    null,
                    $append->content);
    }

    // in case of a user get a lot of the same notification
    public function removeDuplication($users)
    {
        $notYetNotifyUsers = [];
        foreach ($users as $user) {
            if (!in_array($user->id, $this->notifiedUsers)) {
                $notYetNotifyUsers[] = $user;
                $this->notifiedUsers[] = $user->id;
            }
        }
        return $notYetNotifyUsers;
    }
}