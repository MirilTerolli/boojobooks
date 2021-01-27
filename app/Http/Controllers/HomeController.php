<?php

namespace App\Http\Controllers;

use App\Models\UserBooksCollection;

class HomeController extends Controller
{
    /**
     * @return array
     */
    private function getCollectedBooks() {
        $userBooksCollection = UserBooksCollection::where('user_id', auth()->user()->getAuthIdentifier())->first();

        return !empty($userBooksCollection) ? $userBooksCollection->books_collection : json_encode([]);
    }

    /**
     * Render the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard', [
            'collectedBooks' => $this->getCollectedBooks()
        ]);
    }

    /**
     * Render the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function booksList()
    {
        return view('book-collection', [
            'collectedBooks' => $this->getCollectedBooks()
        ]);
    }
}
