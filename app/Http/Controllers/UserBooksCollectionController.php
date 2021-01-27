<?php

namespace App\Http\Controllers;

use App\Models\UserBooksCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserBooksCollectionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sync(Request $request)
    {

        $userBooksCollection = UserBooksCollection::where('user_id', auth()->user()->getAuthIdentifier())->first();
        $selectedBooks = collect($request->input('booksCollection'));
        if($userBooksCollection) {
            $userBooksCollection->books_collection = $selectedBooks;
            $userBooksCollection->save();
        } else {
            $userBooksCollection = new UserBooksCollection();
            $userBooksCollection->user_id = auth()->user()->getAuthIdentifier();
            $userBooksCollection->books_collection = $selectedBooks;
            $userBooksCollection->save();
        }

        return response()->json([
            'collection' => $userBooksCollection->books_collection
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param UserBooksCollection $userBooksCollection
     * @return Response
     */
    public function show(UserBooksCollection $userBooksCollection)
    {
        return response($userBooksCollection);
    }
}
