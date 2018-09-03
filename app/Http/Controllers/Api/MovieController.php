<?php

namespace App\Http\Controllers\Api;

use App\Movie;
use App\Transformers\MovieTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index() {
        $movies = Movie::all();

        $data = fractal()->transformWith(new MovieTransformer)->collection($movies)->toArray();

        return getDataResponse($data);
    }

    public function show($id) {
        $movie = Movie::find($id);
        $data = fractal()->transformWith(new MovieTransformer)->item($movie)->toArray();
        return getDataResponse($data);
    }

    public function store(Request $request) {

        if (empty($request->get('id'))) {
            Movie::create($request->all());
        }else {
            $movie = Movie::findOrFail($request->get('id'));
            $movie->update($request->all());
        }
        return successResponse();
    }

    public function destroy($id){
        Movie::findOrFail($id)->delete();
        return successResponse();
    }

    /*public function update(Request $request, $id) {
        $movie = Movie::findOrFail($id);

        $movie->update($request->all());
        return successResponse();
    }*/
}
