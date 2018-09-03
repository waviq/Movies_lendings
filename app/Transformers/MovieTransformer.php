<?php

namespace App\Transformers;

use App\Movie;
use League\Fractal\TransformerAbstract;

class MovieTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Movie $movie)
    {
        return [
            'id'            =>  $movie->id,
            'title'         =>  $movie->title,
            'genre'         =>  $movie->genre,
            'release_date'  =>  date('Y-m-d',strtotime($movie->release_date)),
            'created_at'    =>  date('Y-m-d h:m:s',strtotime($movie->created_at))
        ];
    }
}
