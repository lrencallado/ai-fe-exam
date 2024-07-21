<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Enums\Type;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Article;
use App\Models\Company;
use App\Models\User;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function __construct(protected ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Article/Index', [
            'articles' => Article::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Initial Creation
        $article = $this->articleRepository->initial($request->user()->id);

        return redirect()->route('articles.edit', ['article' => $article->id])->banner('Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article, User $user, Request $request)
    {
        if ($request->user()->type === Type::WRITER->value && $request->user()->id != $article->writer) {
            return redirect()->back()->dangerBanner('Your are not allowed to edit this article.');
        }

        if ($request->user()->type === Type::EDITOR->value && $request->user()->id != $article->editor) {
            return redirect()->back()->dangerBanner('Your are not allowed to edit this article.');
        }

        if ($article->status == Status::FOR_EDIT->value) {
            return Inertia::render('Article/Edit', [
                'article' => $article,
                'tinymce_api_key' => config('services.tinymce.api_key'),
                'companies' => Company::all(),
                'editors' => $user->editors(),
            ]);
        }

        return redirect()->back()->dangerBanner('Updating a published article is not allowed.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Article $article)
    {
        if ($request->user()->type === Type::WRITER->value && $request->user()->id != $article->writer) {
            return redirect()->back()->dangerBanner('Your are not allowed to edit this article.');
        }

        if ($request->user()->type === Type::EDITOR->value && $request->user()->id != $article->editor) {
            return redirect()->back()->dangerBanner('Your are not allowed to edit this article.');
        }

        $article->update($request->all());

        $request->session()->flash('flash.banner', 'Updated successfully!');

        return;
    }

     /**
     * Publish an article.
     */
    public function publish(Article $article, Request $request)
    {
        $article->status = Status::PUBLISHED;
        $article->save();

        $request->session()->flash('flash.banner', 'This article has been published!');

        return;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
