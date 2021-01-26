<?php


namespace App\GoogleApi;


use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class GoogleApiClient
{

    /**
     * Searches a book based on the search parameter.
     * @param string $url The URL.
     * @param string $input The search input string.
     * @return Response
     */
    public function search(string $url, string $input): Response
    {
       return Http::get($url, [
           'q' => $input
       ]);
    }

}
