<?php

namespace App\Http\Livewire\Admin;

use App\Models\Room_type;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RoomTpye extends Component
{

    public $state =[];
    public $showEditModal = false;
    public $Roomtype;
    public $view_room_type;
    public $view_room_price;
    public $Roomtype_delete_id =null;



    public function addNew(){
        $this->reset();
        $this ->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');

    }
    public function create(){
        $ValidateData =  Validator::make($this ->state,[
        'room_types' => 'required|unique:room_types',
        'price'=> 'required',
       ])->validate();

       Room_type::create($ValidateData);

       $this->dispatchBrowserEvent('hide-form',['message' => 'Room Type added successfully!']);


    }
    public function edit(Room_type $roomtype){
        $this->showEditModal = true;
        $this ->Roomtype =$roomtype;
        $this -> state=$roomtype->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update(){
       
        $ValidateData =  Validator::make($this ->state,[
            'room_types' => 'required|unique:room_types,room_types,'.$this->Roomtype->id,
            'price'=> 'required',
           ])->validate();
    
           $this ->Roomtype ->update($ValidateData);
           $this->dispatchBrowserEvent('hide-form',['message' => 'Room Type Upadate successfully!']);
    
    
    }



    public function showDetail(Room_type $roomtype){
        
        $this->showEditModal = true;
        $this ->Roomtype =$roomtype;

        $this -> state =$roomtype->toArray();
        $this->view_room_type = $this->state['room_types'];
        $this->view_room_price = $this->state['price'];
        $this->dispatchBrowserEvent('show-form-detail');
    }


    public function comfirmUserRemoval($id){
        $this->Roomtype_delete_id =$id;
        $this->dispatchBrowserEvent('show-form-delete');
        
    }


    public function delete(){
        $Roomtype =Room_type::findOrFail($this->Roomtype_delete_id);
        $Roomtype ->delete();
        $this->dispatchBrowserEvent('hide-delete-modal',['message' => 'Room-type delete successfully']);
    }

    public function render()
    {
       
        $roomtypes =Room_type::query()
        ->latest()->paginate(5);

        
        
        return view('livewire.admin.room-tpye',[
            'roomtypes'=>$roomtypes
        ]);
    }
}
