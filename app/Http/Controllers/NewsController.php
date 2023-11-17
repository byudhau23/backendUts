<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$news = News::all();

		if (!empty($news)) {
			$response = [
				'message' => 'Menampilkan Semua Berita',
				'data' => $news,
			];
			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data tidak ada'
			];
			return response()->json($response, 404);
		}
    }

    public function store(Request $request)
    {
        $input = $request->validate([
                'title' => 'required',
                'author' => 'requaired',
                'description' => 'requaired',
                'content' => 'requaired',
                'url' => 'requaired',
                'url_img' => 'requaired',
                'published_at' => 'nullable',
                'category' => 'requaired'
        ]);
        $news = News::create($input);

		$response = [
			'message' => 'Data Berita Berhasil Dibuat',
			'data' => $news,
		];

		return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::find($id);

		if ($news) {
			$response = [
				'message' => 'Get detail news',
				'data' => $news
			];
	
			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data not found'
			];
			
			return response()->json($response, 404);
		}
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::find($id);

		if ($news) {
			$response = [
				'message' => 'News is updated',
				'data' => $news->update($request->all())
			];
	
			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data not found'
			];

			return response()->json($response, 404);
		}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);

		if ($news) {
			$response = [
				'message' => 'News is delete',
				'data' => $news->delete()
			];

			return response()->json($response, 200); 
		} else {
			$response = [
				'message' => 'Data not found'
			];

			return response()->json($response, 404);
		}
	}
    
}

