<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book
{
    use HasFactory;

    private $id;
    private $title;
    private $snipped;
    private $authors;
    private $publishedDate;
    private $smallThumbnail;
    private $thumbnail;
    private $selected;
    private $position;

}
