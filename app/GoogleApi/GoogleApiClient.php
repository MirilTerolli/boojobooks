<?php


namespace App\GoogleApi;


use App\Collections\BookCollection;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class GoogleApiClient
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
        $this->baseUrl = config('googleapi.base_url');
    }

    /**
     * Searches a book based on the search parameter.
     * @param string $input The search input string.
     * @return Response
     */
    public function search(string $input): Response
    {
       return Http::get($this->baseUrl, [
           'q' => $input
       ]);
    }
}
