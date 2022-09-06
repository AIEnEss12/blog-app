<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return response()->json([
            'data' => News::all()
        ], 200);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        try {
            return response()->json([
               'data' => News::findOrFail($id)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Не найдено'
            ], 404);
        }
    }
    
    /**
     * strore
     *
     * @param  Request $request
     * @return void
     */
    public function strore(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:200'],
            'body'  => ['required', 'string'] 
        ],[
            'title.required' => 'Название стать обязательно',
            'body.required'  => 'Содержание статьи обязательно'
        ]);
        News::create($request->all());

        return response()->json([
            'message' => 'Данные успешно добавлены'
        ], 200);
    }
    
    /**
     * update
     *
     * @param  Request $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string']
        ], [
            'title.required' => 'Название стать ибязательно',
            'body.required'  => 'Содержание статьи обязательно'
        ]);

        News::where('id', $id)->update($request->all());
        
        return response()->json([
            'message' => 'Данные успешно обновлены'
        ], 200);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();

        return response()->json([
            'message' => 'Данные успешно удалены'
        ], 200);
    }

}
