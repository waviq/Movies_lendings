<?php

namespace App\Http\Controllers\Api;

use App\Member;
use App\Transformers\MemberTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index() {
        $members = Member::orderBy('created_at', 'DESC')->get();

        $data = fractal()->transformWith(new MemberTransformer)->collection($members)->toArray();

        return getDataResponse($data);
    }
    public function show($id) {
        $member = Member::find($id);
        $data = fractal()->transformWith(new MemberTransformer)->item($member)->toArray();
        return getDataResponse($data);
    }

    public function store(Request $request) {

        if (empty($request->get('id'))) {
            Member::create($request->all());
        }else {
            $movie = Member::findOrFail($request->get('id'));
            $movie->update($request->all());
        }
        return successResponse();
    }

    public function destroy($id){
        Member::findOrFail($id)->delete();
        return successResponse();
    }

    public function memberActive() {
        $members = Member::where('is_active', 1)->orderBy('created_at', 'DESC')->get();

        $data = fractal()->transformWith(new MemberTransformer)->collection($members)->toArray();

        return getDataResponse($data);
    }
}
