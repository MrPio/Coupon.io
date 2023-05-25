<?php

namespace App\Http\Controllers;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Coupon;
use App\Models\Resources\FAQ;
use App\Models\Resources\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;


class TestController extends Controller
{
    public function testGet(Request $request)
    {
        return response()->json(['result' => 'success', 'request' => $request]);
    }
    public function testPost(Request $request)
    {
//        abort(443);
        return response()->json(['result' => 'success', 'request' => $request['key1']]);
    }
}
