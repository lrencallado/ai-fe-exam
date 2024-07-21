<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Enums\Type;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->type == Type::WRITER->value) {
            $forEdit = $request->user()->writerArticles->where('status', Status::FOR_EDIT->value)->take(1);
            $published = $request->user()->writerArticles->where('status', Status::PUBLISHED->value)->take(1);
        } else {
            $forEdit = $request->user()->editorArticles->where('status', Status::FOR_EDIT->value)->take(1);
            $published = $request->user()->editorArticles->where('status', Status::PUBLISHED->value)->take(1);
        }

        return Inertia::render('Dashboard', [
            'articles' => collect($forEdit)->merge($published)
        ]);
    }
}
