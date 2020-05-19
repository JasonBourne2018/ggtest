<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Validators\Upload;
use Carbon\Carbon;

class IndexController extends Controller {
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => 'download'
        ]);
    }

    public function index(Request $request) {
        return $request->user;
    }

    public function upload(Request $request) {
        $this->validate($request, Upload::rules(), Upload::messages(), Upload::attributes());
        //$path = Storage::putFile(Carbon::now()->format('Y/m/d'), $request->file('file'));
        $uid = '100';
        //var_dump($request->file('file'));
        $name = $request->file('file')->getClientOriginalName();
        //$path = Storage::putFile($uid, $request->file('file'),$name);
        $path = Storage::putFileAs($uid, $request->file('file'),$name);
        return ['code' => 200, 'message' => 'success', 'data' => $path];
    }
    public function download(Request $request)
    {
        $name = $request->name;
        $uid = '100';
        $path = $uid.'/'.$name;
        return Storage::download($path);
    }
    public function directories() {
        $uid = '100';
        return response()->json(Storage::files($uid));
    }
}
