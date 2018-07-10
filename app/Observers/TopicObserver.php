<?php

namespace App\Observers;

use App\Models\Topic;
use function clean;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');
        $topic->excerpt = makeExcerpt($topic->body);
    }
}