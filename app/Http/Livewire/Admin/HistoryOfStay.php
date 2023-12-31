<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Carbon\Carbon;





class HistoryOfStay extends Component

{
    use WithPagination;
    public $tatol_price = 0;
    public $day, $date, $year,$month;
    public $customer_name, $customer_phone, $check_in, $check_out, $room_price, $room_tatol_p;


    protected $paginationTheme = 'bootstrap';





    public function print($id)
    {
        $this->date = date('D-m-Y');

        $Booking = DB::table('bookings')

            ->join('customers', 'customer_id', '=', 'customers.id')
            ->join('rooms', 'room_id', '=', 'rooms.id')
            ->join('room_types', 'room_type_id', '=', 'room_types.id')
            ->select('bookings.*', 'customers.customer_name', 'customers.customer_phone', 'room_types.room_types', 'room_types.price', 'rooms.room_no')
            ->where('bookings.id', '=', $id)
            ->get();
        foreach ($Booking as $data) {
            $this->customer_name = $data->customer_name;
            $this->customer_phone = $data->customer_phone;
            $this->check_in = $data->check_in;
            $this->check_out = $data->check_out;
            $this->room_price = $data->price;
            $this->room_tatol_p = $data->total_price;
            $checkInDate = Carbon::parse($data->check_in);
            $checkOutDate = Carbon::parse($data->check_out);
            $this->day = $checkInDate->diffInDays($checkOutDate);
        }
        $this->dispatchBrowserEvent('show-form-print_id');
    }


    public function render()
    {
        if($this->year && $this->month){
            $year = $this->year;
            $month= $this->month;
            $Booking = DB::table('bookings')
                ->join('customers', 'customer_id', '=', 'customers.id')
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->select('bookings.*', 'customers.customer_name', 'customers.customer_phone', 'room_types.room_types', 'rooms.room_no')
                ->where('bookings.payment_status', '=', '1')
                ->whereYear('bookings.created_at','=', $year)
                ->whereMonth('bookings.created_at','=', $month)
                ->orderBy('bookings.id', 'desc')
                ->latest()->paginate(10);
            $this->tatol_price = 0;
            foreach ($Booking as $data) {
                $this->tatol_price += $data->total_price;
            }

        }

        else if ($this->year) {
            $year = $this->year;
            $Booking = DB::table('bookings')
                ->join('customers', 'customer_id', '=', 'customers.id')
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->select('bookings.*', 'customers.customer_name', 'customers.customer_phone', 'room_types.room_types', 'rooms.room_no')
                ->where('bookings.payment_status', '=', '1')
                ->whereYear('bookings.created_at','=', $year)
                ->orderBy('bookings.id', 'desc')
                ->latest()->paginate(10);
            $this->tatol_price = 0;
            foreach ($Booking as $data) {
                $this->tatol_price += $data->total_price;
            }
        }
        else if ($this->month) {
            $month = $this->month;
            $Booking = DB::table('bookings')
                ->join('customers', 'customer_id', '=', 'customers.id')
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->select('bookings.*', 'customers.customer_name', 'customers.customer_phone', 'room_types.room_types', 'rooms.room_no')
                ->where('bookings.payment_status', '=', '1')
                ->whereMonth('bookings.created_at','=', $month)
                ->orderBy('bookings.id', 'desc')
                ->latest()->paginate(10);
            $this->tatol_price = 0;
            foreach ($Booking as $data) {
                $this->tatol_price += $data->total_price;
            }
        } 
         else {
            $Booking = DB::table('bookings')
                ->join('customers', 'customer_id', '=', 'customers.id')
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->select('bookings.*', 'customers.customer_name', 'customers.customer_phone', 'room_types.room_types', 'rooms.room_no')
                ->where('bookings.payment_status', '=', '1')

                ->orderBy('bookings.id', 'desc')
                ->latest()->paginate(10);
            $this->tatol_price = 0;
            foreach ($Booking as $data) {
                $this->tatol_price += $data->total_price;
            }
        }








        $dates = date('d-m-Y');
        return view('livewire.admin.history-of-stay', [
            'booking' => $Booking,
            'dates' => $dates,

        ]);
    }
}
