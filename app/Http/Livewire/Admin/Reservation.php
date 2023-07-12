<?php

namespace App\Http\Livewire\Admin;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Room_type;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Reservation extends Component
{
    public $Room;
    public $Room_type = null, $Room_types;
    public $state = [];
    public $day = 0, $room_price, $total_price = 0;
    public $check_in_date, $check_out_date = null;


    public function onchang()
    {


        $checkInDate = Carbon::parse($this->check_in_date);
        $checkOutDate = Carbon::parse($this->check_out_date);

        if ($checkInDate >= $checkOutDate) {
            $this->dispatchBrowserEvent('Error', ['message' => 'ກະລຸເລືອກວັນທີ່ໃຫ້ຫຼາຍກ່ວາວັນທີ່ເຂົ້າ!!!!']);
            $this->day = 0;
            $this->total_price = 0;
            $this->state['check_out_date'] = null;
        } else {
            $this->day = $checkInDate->diffInDays($checkOutDate);
            $this->total_price = $this->day * $this->room_price;
        }
    }


    public function handleCheckOutDateChange($value)
    {
        if (!$this->check_in_date) {
            $this->dispatchBrowserEvent('Error', ['message' => 'ກະລຸນາເລືອກວັນທີ່ check In ກ່ອນ !!!!']);
            $this->state['check_out_date'] = null;
        } else {
            $this->check_out_date = $value;
            $this->onchang();
        }
    }


    public function handleCheckInDateChange($value)
    {
        $this->check_in_date = $value;
        $this->onchang();
    }
    public function handleCheckRoom_type_DateChange($value)
    {
        $this->Room_type = null;

        $this->Room_type = $value;
        $room_type = Room_type::where('id', $value)->first();

        if ($room_type) {
            $this->room_price = $room_type->price;
        };
        if ($value == 'null') {
            $this->room_price = 0;
            $this->Room_type = null;
        }
        $this->onchang();
    }


    public function booking()
    {
        $data = Validator::make($this->state, [
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_lastname' => 'required',
            'room_no' => 'required',
            'room_type' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
        ])->validate();

        $Customerdata = [
            'customer_name' => $data['customer_name'] . ' ' . $data['customer_lastname'],
            'customer_phone' => $data['customer_phone'],
        ];

        try {
            DB::beginTransaction();

            Customer::create($Customerdata);
            $Customer = Customer::orderBy('id', 'desc')->first();
            $Bookingdata = [
                'customer_id' => $Customer->id,
                'room_id' => $data['room_no'],
                'check_in' => $data['check_in_date'],
                'booking_date'=> Carbon::now(),
                'check_out' => $data['check_out_date'],
                'total_price' => $this->total_price,
            ];
           
            Booking::create($Bookingdata);
            //update room status 
            $room = Room::find($data['room_no']);
            $room->update(['status' => '1']);
            
            DB::commit();

            $this->dispatchBrowserEvent('Booking_success', ['message' => 'Booking successful!']);
            $this->reset();
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->dispatchBrowserEvent('Error', ['message' => 'ມີບາງຢ່າງຜິດພາດ']);
        }
    }


    public function render()
    {

        $Roomid = request('Roomid');
        if ($Roomid) {
            $Room = DB::table('rooms')
                ->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->select('rooms.*', 'room_types.room_types as type_name')
                ->where('rooms.id', '=', $Roomid)
                ->where('rooms.status', '=', 0)
                ->get();
        } else if ($this->Room_type != null) {
            $Room = DB::table('rooms')
                ->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->select('rooms.*', 'room_types.room_types as type_name')
                ->where('rooms.room_type_id', '=', $this->Room_type)
                ->where('rooms.status', '=', 0)
                ->get();
        } else {
            $Room = DB::table('rooms')
                ->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->select('rooms.*', 'room_types.room_types as type_name')
                ->get();
        }
        $room_type = Room_type::all();


        return view('livewire.admin.reservation', [
            'room' => $Room, 'Roomid' => $Roomid, 'room_type' => $room_type
        ]);
    }
}
