<?php

namespace App\Http\Controllers;

use App\GoogleApi\GoogleApiClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GoogleApiController extends Controller
{
    /**
     * @var mixed The Google API base URL.
     */
    protected $baseUrl;

    /**
     * GoogleApiClient constructor.
     */
    public function __construct()
    {
        $this->baseUrl = env('GOOGLE_BOOKS_API');
        //create a google api config file and grabb it from there (googleapi.config)
        //put the base url class to the api class

    }

    /**
     *
     * @param GoogleApiClient $googleApiClient
     * @param Request $request
     * @return JsonResponse
     */
    public function search(GoogleApiClient $googleApiClient, Request $request): JsonResponse
    {
//        dd(auth()->user());
        $response = $googleApiClient->search($this->baseUrl, $request->search);
        // parse the results on the google api class formatted
        // create a book collection class
        if ($response->json('items')) {
            $items = collect($response->json('items'))->transform(function ($book, $index) {
                return [
                    'id' => "{$book['id']}.{$book['etag']}",
                    'title' => !empty($book['volumeInfo']['title']) ? $book['volumeInfo']['title'] : '',
                    'snipped' => !empty($book['searchInfo']['textSnippet']) ? $book['searchInfo']['textSnippet'] : '',
                    'authors' => !empty($book['volumeInfo']['authors']) ? $book['volumeInfo']['authors'] : [],
                    'publishedDate' => !empty($book['volumeInfo']['publishedDate']) ? $book['volumeInfo']['publishedDate'] : '',
                    'smallThumbnail' => !empty($book['volumeInfo']['imageLinks']) ? $book['volumeInfo']['imageLinks']['smallThumbnail'] : '',
                    'thumbnail' => !empty($book['volumeInfo']['imageLinks']) ? $book['volumeInfo']['imageLinks']['thumbnail'] : '',
                    'selected' => false,
                    'position' => 0
                ];
            });

        } else {
            $items = collect([]);
        }

        $items = $items ? $items : $response->json('items');
        return response()->json([
            'success' => $response->ok(),
            'items' => $items
        ], $response->status());
    }
}
