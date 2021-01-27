<?php

namespace App\Http\Controllers;

use App\Collections\BookCollection;
use App\GoogleApi\GoogleApiClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GoogleApiController extends Controller
{
    /**
     *
     * @param GoogleApiClient $googleApiClient
     * @param Request $request
     * @return JsonResponse
     */
    public function search(GoogleApiClient $googleApiClient, Request $request): JsonResponse
    {
        $response = $googleApiClient->search($request->search);

        if ($response->json('items')) {
            $items = (new BookCollection($response->json('items')))->forFrontend();
        } else {
            $items = (new BookCollection([]))->forFrontend();
        }

        return response()->json([
            'success' => $response->ok(),
            'items' => $items
        ], $response->status());
    }
}
