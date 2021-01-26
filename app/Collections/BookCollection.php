<?php


namespace App\Collections;


use Illuminate\Support\Collection;

class BookCollection extends Collection
{
    public function forFrontend()
    {
        $this->transform(function ($item){
           //
        });
    }

}
