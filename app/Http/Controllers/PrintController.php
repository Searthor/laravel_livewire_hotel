<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrintController extends Controller
{
    
    //
    public function printhistoryStay(){
        $day = null;
        $date = date('m/d/Y');
        $tatol_price=0;
        $id = request('id');
       if($id != null){
        $Booking = DB::table('bookings')
        ->join('customers', 'customer_id', '=', 'customers.id')
        ->join('rooms', 'room_id', '=', 'rooms.id')
        ->join('room_types', 'room_type_id', '=', 'room_types.id')
        ->select('bookings.*', 'customers.customer_name','customers.customer_phone','room_types.room_types','room_types.price','rooms.room_no')
        ->Where('bookings.id','=',$id)
        ->get();
        foreach ($Booking as $data){
        $checkInDate = Carbon::parse($data->check_in);
        $checkOutDate = Carbon::parse($data->check_out);
        $day = $checkInDate->diffInDays($checkOutDate);

        }
       }else{
        $Booking = DB::table('bookings')
        ->join('customers', 'customer_id', '=', 'customers.id')
        ->join('rooms', 'room_id', '=', 'rooms.id')
        ->join('room_types', 'room_type_id', '=', 'room_types.id')
        ->select('bookings.*', 'customers.customer_name','customers.customer_phone','room_types.room_types','rooms.room_no')
        ->where('bookings.payment_status','=','1')
        ->orderBy('bookings.id', 'desc')
        ->get();
        
        foreach ($Booking as $data) {
            $tatol_price += $data->total_price;
         
        }

       }
       
        return view('print',[
            'tatol_price'=>$tatol_price,
            'booking'=>$Booking,
            'id'=>$id,
            'date'=>$date,
            'day'=>$day

        ]);
    }
}
