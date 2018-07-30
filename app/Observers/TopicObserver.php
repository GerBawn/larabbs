<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Topic;
use function clean;
use function dispatch;
use Illuminate\Support\Facades\DB;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');
        $topic->excerpt = makeExcerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        if (!$topic->slug) {
            dispatch(new TranslateSlug($topic));
        }
    }

    public function deleted(Topic $topic)
    {
        DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}