<?php

namespace App\Http\Livewire\Admin;

use App\Models\Room;
use App\Models\Room_type;
use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManageRoots extends Component
{


    public $state = [];
    public $showEditModal = false;
    public $Room, $booking_id,$Room_id = null;
    public $view_room_type, $view_room_no, $view_room_status,
        $booking_totalprice, $booking_check_in, $booking_check_out,$Advance_Payment,$Remaining_Amount = null;
    public $Room_delete_id = null;
    public $room_status_edit = null;
    public $customer_name,$customer_phone,$check_in,$check_out,$room_price,$room_tatol_p;
    public $day, $date;


    public function addNew()
    {
        $this->reset();
        $this->room_status_edit = null;
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }
    public function setEditData($id){
        $booking = DB::table('bookings')
            ->join('rooms', 'room_id', '=', 'rooms.id')
            ->select('bookings.*')
            ->where('bookings.payment_status', '=', '0')
            ->where('rooms.id', '=', $id)
            ->get();
        foreach ($booking as $date) {
            $this->booking_id = $date->id;
            $this->booking_check_in = $date->check_in;
            $this->booking_check_out = $date->check_out;
            $this->booking_totalprice = $date->total_price;
        }

        $Room = DB::table('rooms')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.room_types as type_name')
            ->where('rooms.id', '=', $id)
            ->get();
        foreach ($Room as $date) {
            $this->view_room_no = $date->room_no;
            $this->Room_id = $date->id;
            $this->view_room_type = $date->type_name;
        }
        $customer = DB::table('bookings')
            ->join('customers', 'customer_id', '=', 'customers.id')
            ->select('bookings.id', 'customers.customer_name')
            ->where('bookings.id', '=', $this->booking_id)
            ->get();
        foreach ($customer as $date) {
            $this->customer_name = $date->customer_name;    
        }
        // dd($customer);
    }
// check in
    public function check_in($id)
    {
        $this->setEditData($id);
        $this->dispatchBrowserEvent('show-form-check_in');
    }
// set check in data
    public function Set_Check_in_data(){
        $ValidateData =  Validator::make($this->state, [
            'advance_payment' => 'required',
        ])->validate();
    
        if($ValidateData['advance_payment'] >= 0){
            DB::transaction(function () use ($ValidateData) {
                $room = Room::find($this->Room_id);
                $booking = Booking::find($this->booking_id);
                $remaining_price = $this->booking_totalprice - $ValidateData['advance_payment'] ;
                
                $booking->update(['advance_payment' => $ValidateData['advance_payment'],
                                'remaining_price'=> $remaining_price ]);
                $room->update(['status' => '2']);
            });
        }
        
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Room Check In successfully!']);
    }

// end check in

// stast check out
    public function check_out($id)
    {
        $booking = DB::table('bookings')
            ->join('rooms', 'room_id', '=', 'rooms.id')
            ->select('bookings.*')
            ->where('bookings.payment_status', '=', '0')
            ->where('rooms.id', '=', $id)
            ->get();
        foreach ($booking as $data) {
            $this->booking_id = $data->id;
            $this->booking_check_in = $data->check_in;
            $this->booking_check_out = $data->check_out;
            $this->booking_totalprice = $data->total_price;
            $this->Advance_Payment = $data->advance_payment;
            $this->Remaining_Amount =$data->remaining_price;
        }

        $Room = DB::table('rooms')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.room_types as type_name')
            ->where('rooms.id', '=', $id)
            ->get();
        foreach ($Room as $date) {
            $this->view_room_no = $date->room_no;
            $this->Room_id = $date->id;
            $this->view_room_type = $date->type_name;
        }
        $customer = DB::table('bookings')
            ->join('customers', 'customer_id', '=', 'customers.id')
            ->select('bookings.id', 'customers.customer_name')
            ->where('bookings.id', '=', $this->booking_id)
            ->get();
        foreach ($customer as $date) {
            $this->customer_name = $date->customer_name;    
        }
        // dd($customer);

        $this->dispatchBrowserEvent('show-form-check_out');
    }

    

    public function Set_Check_out_data(){

        $ValidateData = Validator::make($this->state, [
            'Remaining_Amount' => ['required', function ($attribute, $value, $fail) {
                if ($value != $this->Remaining_Amount) {
                    $fail('The remaining amount must be equal to ' . $this->Remaining_Amount . '.');
                }else{
                    
                }
            }],
        ])->validate();
    
        if($ValidateData['Remaining_Amount'] == $this->Remaining_Amount){
            DB::transaction(function () use ($ValidateData) {
                $room = Room::find($this->Room_id);
                $booking = Booking::find($this->booking_id);
                $booking->update(['advance_payment' => '0' ,
                                    'remaining_price'=> '0',
                                    'payment_status'=>'1']);
        
                $room->update(['status' => '0']);
            });
        }
        $this->date = date('D/m/Y');

        $Booking = DB::table('bookings')

                ->join('customers', 'customer_id', '=', 'customers.id')
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->select('bookings.*', 'customers.customer_name', 'customers.customer_phone', 'room_types.room_types', 'room_types.price', 'rooms.room_no')
                ->where('bookings.id', '=',$this->booking_id )
                ->get();
            foreach ($Booking as $data) {
                $this->customer_name = $data->customer_name;
                $this->customer_phone =$data->customer_phone;
                $this->check_in = $data->check_in;
                $this->check_out = $data->check_out;
                $this->room_price = $data->price;
                $this->room_tatol_p = $data->total_price;
                $checkInDate = Carbon::parse($data->check_in);
                $checkOutDate = Carbon::parse($data->check_out);
                $this->day = $checkInDate->diffInDays($checkOutDate);

            }

        $this->dispatchBrowserEvent('show-form-print', ['message' => 'Room Check Out successfully!']);
  
    }

//   end check out data


    public function createRoom()
    {


        if (is_array($this->state)) {
            $ValidateData = Validator::make($this->state, [
                'room_type_id' => 'required',
                'room_no' => 'required|unique:rooms',

            ])->validate();

            // rest of your code
        } else {
            // handle the case where $this->state is not an array
        }

        Room::create($ValidateData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Room Type added successfully!']);
    }





    public function edit($id)
    {
        $this->showEditModal = true;
        $this->Room = Room::where('id', $id)->first();
        $this->state['room_type_id'] = $this->Room->room_type_id;
        $this->state['room_no'] = $this->Room->room_no;
        $this->room_status_edit = $this->Room->status;
        $this->dispatchBrowserEvent('show-form');
        // if($this->Room->status !=0){
        //     $this->setEditData($id);
        //     $this->dispatchBrowserEvent('show-form-edit');
        // }
        // else{
        //     $this->dispatchBrowserEvent('show-form');
        // }

    }

    public function update()
    {

        // dd($this->state);
        $ValidateData =  Validator::make($this->state, [
            'room_type_id' => 'required',
            'room_no' => 'required|unique:rooms,room_no,' . $this->Room->id,
        ])->validate();

        $this->Room->update($ValidateData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Room Upadate successfully!']);
    }


    public function showDetail($id)
    {

        // $this->Room = Room::where('id', $id)->first();

        $this->Room = DB::table('rooms')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.room_types as type_name')
            ->where('rooms.id', '=', $id)
            ->get();

        foreach ($this->Room as $room) {
            $this->view_room_type = $room->type_name;
            $this->view_room_no = $room->room_no;
            $this->view_room_status = $room->status;
            // Do something with the extracted values
        }
        $this->dispatchBrowserEvent('show-form-detail');
    }



    public function comfirmRemoval($id)
    {
        $this->Room = Room::where('id', $id)->first();
        $this->Room_delete_id = $this->Room->id;
        $this->room_status_edit = $this->Room->status;

        $this->dispatchBrowserEvent('show-form-delete');
    }
    public function delete()
    {
        $Room = Room::findOrFail($this->Room_delete_id);
        $Room->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Room delete successfully']);
    }



    public function render()
    {

        $All_room = Room::all()->count();
        $Booking_room = Room::All()->where( 'status' , ' = ', '1')->count();
        $Guest_room = Room::All()->where( 'status' , ' = ', '0')->count();
        $Check_In_room = Room::All()->where( 'status' , ' = ', '2')->count();
        $status = request('status');
        
        $room_type = Room_type::all();
        //$room =Room::all();
        if ($status == '0'){
            $room = DB::table('rooms')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.room_types as type_room_name')
            ->where('status', '=', $status)
            ->get();

        }
        else if($status == '1'){
            $room = DB::table('rooms')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.room_types as type_room_name')
            ->where('status', '=', $status)
            ->get();

        }
        else if($status == '2'){
            $room = DB::table('rooms')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.room_types as type_room_name')
            ->where('status', '=', $status)
            ->get();

        }
        else{
            $room = DB::table('rooms')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.room_types as type_room_name')
            ->get();

        }
        
        return view('livewire.admin.manage-roots', [
            'roomtype' => $room_type,
             'room' => $room,
             'all_room'=>$All_room,
            'booking_room'=>$Booking_room,
            'guest_room'=>$Guest_room,
            'check_in_room'=>$Check_In_room,
        ]);
    }
}
