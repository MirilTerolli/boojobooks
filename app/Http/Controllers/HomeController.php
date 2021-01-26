<?php

namespace App\Http\Controllers;

use App\Models\UserBooksCollection;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard', [
            'collectedBooks' => $this->getCollectedBooks()
        ]);
    }

    public function booksList()
    {
        return view('book-collection', [
            'collectedBooks' => $this->getCollectedBooks()
        ]);
    }

    private function getCollectedBooks() {
        $userBooksCollection = UserBooksCollection::where('user_id', auth()->user()->getAuthIdentifier())->first();
        return !empty($userBooksCollection) ? $userBooksCollection->books_collection : [];
    }
}
