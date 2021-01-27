<?php


namespace App\Collections;


use App\Entities\Book;
use Illuminate\Support\Collection;

class BookCollection extends Collection
{
    /**
     * @return BookCollection
     */
    public function forFrontend(): BookCollection
    {
        return $this->transform(function ($book){
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
    }

}
