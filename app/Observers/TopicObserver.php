<?php

namespace App\Observers;

use App\Models\Topic;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->excerpt = makeExcerpt($topic->body);
    }
}