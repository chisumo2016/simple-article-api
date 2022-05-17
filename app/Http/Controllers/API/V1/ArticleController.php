<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : ResourceCollection
    {
        return new ArticleCollection(Article::all());
    }
//Return value is expected to be '\Illuminate\Http\Response', '\App\Http\Resources\V1\ArticleCollection' returned
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) :JsonResponse
    {
        $this->validate($request, [
            'title' => ['required','max:20','unique:articles,title'],
            'description'=> ['required','min:5']
        ]);

        $article = Article::create([
            'title'         => $request->input('title'),
            'slug'          => Str::slug($request->input('title')),
            'description'   => $request->input('description'),
            'author_id'     => auth()->id() ?? 1
        ]);

        return  (new ArticleResource($article))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article) : JsonResponse
    {
        return   (new ArticleResource($article))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article): JsonResponse
    {
        $this->validate($request, [
            'title' => ['sometimes','max:20',Rule::unique('articles')->ignore($article->title(),'title')],
            'description'=> ['required','min:5']
        ]);

        $article->update([
            'title'         => $request->input('title'),
            'slug'          => Str::slug($request->input('title')),
            'description'   => $request->input('description'),
            'author_id'     => auth()->id() ?? 1
        ]);

        return  (new ArticleResource($article))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article):JsonResponse
    {
        $article->delete();
        return response()->json(null,204);
    }
}
