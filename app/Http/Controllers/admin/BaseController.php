<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function __construct(Request $request){
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Methods: *');
//        header('Access-Control-Allow-Headers: *');
//        header('Access-Control-Allow-Origin', '*');
//                        header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
//                        header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Request-With, api-key');
//                        header('Access-Control-Allow-Credentials', ' true');
    }

}
