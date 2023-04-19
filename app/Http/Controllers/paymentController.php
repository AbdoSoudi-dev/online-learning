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

        return $myPayments;
    }
    public function store(Request $request)
    {
        Payment::create($request->all());
        return true;
    }
    public function checkPayments($id, Request $request)
    {
        $bookingsUser = Booking::whereDoesntHave("payment")
               ->whereUser_id($request->user()->roler_id == 1 ? $request->user()->id : $id)
               ->groupBy("booking_group_id")
               ->selectRaw("MIN(id) id, booking_group_id")
               ->get();
        $checkPayments = [];
        foreach ($bookingsUser as $book) {
            $book->setAppends([]);
            $checkPayments['count'] = count($bookingsUser) ? 1 : false;
            $checkPayments[$book['booking_group_id']] = $book;
        }

        return $checkPayments;
    }
    public function allPayments()
    {
        $payments = Payment::with(["user","booking"=>function($query){
            $query->with("course");
        }])->latest()->get();
        return $payments;
    }
}
