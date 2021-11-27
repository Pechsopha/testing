<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advs;
use Carbon\Carbon;

class AdvsController extends Controller
{
    public function getAdvs()
    {
        $date = Carbon::now();
        $date = date('Y-m-d', strtotime($date));
        $query = Advs::where('status', 'published')->whereDate('fromdate', '<', $date)->whereDate('todate', '>', $date)->get();
        return  response()->json(['data' => $query]);
    }
}