<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboarController extends Controller
{

    
    public function __invoke(Request $request)
    {
        $All_room = Room::all()->count();
        $employees = staff::all()->count();
        $Booking_room = Room::All()->where( 'status' , ' = ', '1')->count();
        $Guest_room = Room::All()->where( 'status' , ' = ', '0')->count();
        $Check_In = Room::All()->where( 'status' , ' = ', '2')->count();

        $room = DB::table('rooms')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.room_types as type_room_name')
            ->where('status', '=', '0')
            ->get();
        
        
        return view('admin.dashboard',[
            'all_room'=>$All_room,
            'booking_room'=>$Booking_room,
            'guest_room'=>$Guest_room,
            'check_in'=>$Check_In,
            'room' => $room,
            'employees'=>$employees
        ]);
        
    }
}
