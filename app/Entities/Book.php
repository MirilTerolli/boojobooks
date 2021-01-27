<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book
{
    use HasFactory;

    private $id;
    private $title;
    private $snipped;
    private $position;
    private $selected;
    private $authors;
    private $thumbnail;
    private $publishedDate;
    private $smallThumbnail;

    public function __construct($fields)
    {
        $this->id = $fields['id'];
        $this->title = $fields['title'];
        $this->snipped = $fields['snipped'];
        $this->position = $fields['position'];
        $this->selected = $fields['selected'];
        $this->authors = $fields['authors'];
        $this->thumbnail = $fields['thumbnail'];
        $this->publishedDate = $fields['publishedDate'];
        $this->smallThumbnail = $fields['smallThumbnail'];
    }


}
