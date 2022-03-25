<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function myPayments(Request $request)
    {
        $myPayments = Payment::with(["booking"=>function($query){
                    $query->with("course");
                }])
                ->whereUser_id($request->user()->id)
                ->get();
        $myPayments = $myPayments->map(function ($pay)use ($request){
            $pay['created_at'] = Carbon::createFromFormat("Y-m-d H:i:s",$pay['created_at']
                                            ,$request->user()->timezone);
            return $pay;
        });

        return response($myPayments,201);
    }
    public function store(Request $request)
    {
        Payment::create($request->all());
        return response("DONE",201);
    }
    public function checkPayments($id, Request $request)
    {
        $id = $request->user()->roler_id == 1 ? $request->user()->id : $id;

        $bookingsUser = Booking::whereDoesntHave("payment")
               ->whereUser_id($id)
               ->groupBy("booking_group_id")
               ->selectRaw("MIN(id) id, booking_group_id")
               ->get();

        $checkPayments = [];
        foreach ($bookingsUser as $item) {
            $checkPayments['count'] = count($bookingsUser) ? 1 : false;
            $checkPayments[$item['booking_group_id']] = $item;
        }

        return response($checkPayments,201);
    }
    public function allPayments()
    {
        $payments = Payment::with(["user","booking"=>function($query){
            $query->with("course");
        }])->latest()->get();
        return response($payments,200);
    }
}
