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
				'data' => $news
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
        $input = [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'content' => $request->content,
                'url' => $request->url,
                'url_img' => $request->url_img,
                'category' => $request->category
        ];
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

    public function search(Request $request, $title)
    {
        $news = News::where('title', 'like', '%' . $title . '%')->get();
        if ($news->isEmpty()) {
            $data = [
                'message' => 'News not found'
            ];

            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Get Searched News',
            'data' => $news
        ];
        return response()->json($news, 404);
    }

    public function sport()
    {
        $news = News::where('category', 'sport')->get();
        if ($news->isEmpty()) {
            $data = [
                'message' => 'News not found'
            ];

            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Get Sport News',
            'total' => $news->count(),
            'data' => $news
        ];

        return response()->json($news, 200);
    }

    public function finance()
    {
        $news = News::where('category', 'finance')->get();
        if ($news->isEmpty()) {
            $data = [
                'message' => 'News not found'
            ];

            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Get Finance News',
            'total' => $news->count(),
            'data' => $news
        ];

        return response()->json($news, 200);
    }

    public function automotive()
    {
        $news = News::where('category', 'automotive')->get();
        if ($news->isEmpty()) {
            $data = [
                'message' => 'News not found'
            ];

            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Get Automotive News',
            'total' => $news->count(),
            'data' => $news
        ];

        return response()->json($data, 200);
    }
    
}

