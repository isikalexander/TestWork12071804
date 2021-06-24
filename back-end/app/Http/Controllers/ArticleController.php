<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{

    /**
     * Правила валидации
     *
     * @var array
     */

    protected $rules = [
        'title' => 'required|max:255|unique:articles',
        'content' => 'required|min:3'
    ];

    /**
     * Сообщения валидации
     *
     * @var array
     */
    protected $messages = [
        'title.required' => 'Название статьи не должно быть пустое',
        'title.max' => 'Максимальная длина названия - 255 символов',
        'title.unique' => 'Название должно быть уникальным',
        'content.required' => 'Текст статьи не должен быть пустым',
        'content.min' => 'Минимальная длина текста статьи - 3 символа'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create()
    {



    }

    /**c
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        // Проверка на ошибки, если есть, то отображаем их в виде массива
        if ( $validator->fails() )
        {

            $message = $validator->messages();
            $error = json_encode($message->all());
            return $error;

        }

        $article = new Article();

        $article->title = $request->title;
        $article->content = $request->content;

        $article->save();

        $result = [
            'status' => [
                'Статья была успешно добавлена!'
            ]
        ];

        $result = json_encode($result);

        return $result;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {

        $article = Article::find($id);

        if  ( !empty($article) ) {

            return json_encode($article);

        }

        return json_encode([
            'error' => [
                'Статья не найдена'
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        // Проверка на ошибки, если есть, то отображаем их в виде массива
        if ( $validator->fails() )
        {

            $message = $validator->messages();
            $error = json_encode($message->all());
            return $error;

        }

        $article = Article::find($id);

        $article->title = $request->title;
        $article->content = $request->content;

        $article->save();

        $result = [
            'status' => [
                'Статья была изменена!'
            ]
        ];

        $result = json_encode($result);

        return $result;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {

        $article = Article::find($id);

        if  ( empty($article) ) {

            return json_encode([
                'error' => [
                    'Статья не найдена'
                ]
            ]);

        }

        $article->delete();

        $result = [
            'status' => [
                'Статья была успешно удалена!'
            ]
        ];

        $result = json_encode($result);

        return $result;

    }
}
