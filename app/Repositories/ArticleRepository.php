<?php

namespace App\Repositories;

use App\Enums\Status;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleRepository extends BaseRepository
{
    public function __construct(Article $article)
    {
        parent::__construct($article);
    }

    public function initial($writer)
    {
        $date = now();
        $title = 'Untitled ' . $date;

        $data = [
            'link' => config('app.url') . '/' . Str::slug($title),
            'title' => $title,
            'status' => Status::FOR_EDIT,
            'writer' => $writer,
            'date' => $date,
        ];

        return $this->create($data);
    }
}
