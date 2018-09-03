<?php

namespace App\Http\Controllers\Api;

use App\Lending;
use App\Transformers\LendingTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LendingController extends Controller
{
    public function index() {
        $lendings = Lending::all();

        $data = fractal()->transformWith(new LendingTransformer)->collection($lendings)->toArray();

        return getDataResponse($data);
    }

    public function store(Request $request) {

        if (empty($request->get('id'))) {
            Lending::create($request->all());
        }else {
            $lending = Lending::findOrFail($request->get('id'));
            $lending->update($request->all());
        }
        return successResponse();
    }

    public function show($id) {
        $lending = Lending::find($id);
        $data = fractal()->transformWith(new LendingTransformer)->item($lending)->toArray();
        return getDataResponse($data);
    }

    public function update(Request $request, $id) {
        $lending = Lending::findOrFail($id);

        $lending->update($request->all());
        return successResponse();
    }

    public function destroy($id){
        Lending::findOrFail($id)->delete();
        return successResponse();
    }
}
