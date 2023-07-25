<?php

namespace App\Http\Livewire\Admin;

use App\Models\Room_type;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RoomTpye extends Component
{

    public $state = [];
    public $showEditModal = false;
    public $Roomtype;
    public $view_room_type;
    public $view_room_price;
    public $Roomtype_delete_id = null, $searchTerm = '';




    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }
    public function create()
    {
        $ValidateData = Validator::make($this->state,
            [
                'room_types' => 'required|unique:room_types',
                'price' => 'required',
            ],
            [
                'room_types.required' => 'ກະລຸປ້ອມຊື່ປະເພດຫ້ອງ!',
                'room_types.unique' => 'ຊື່ປະເພດຫ້ອງນີ້ມີຢູ່ແລ້ວ!',
                'price.required' => 'ກະລຸປ້ອມລາຄາ!'
            ])->validate();

        Room_type::create($ValidateData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'ເພີ່ມປະເພດຫ້ອງສຳເລັດ!']);
    }
    public function edit(Room_type $roomtype)
    {
        $this->showEditModal = true;
        $this->Roomtype = $roomtype;
        $this->state = $roomtype->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $ValidateData =  Validator::make(
            $this->state,
            [
                'room_types' => 'required|unique:room_types,room_types,' . $this->Roomtype->id,
                'price' => 'required',
            ],
            [
                'room_types.required' => 'ກະລຸປ້ອມຊື່ປະເພດຫ້ອງ!',
                'room_types.unique' => 'ຊື່ປະເພດຫ້ອງນີ້ມີຢູ່ແລ້ວ!',
                'price.required' => 'ກະລຸປ້ອມລາຄາ!'
            ]
        )->validate();

        $this->Roomtype->update($ValidateData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'ແກ້ໄຂສຳເລັດ']);
    }
    public function showDetail(Room_type $roomtype)
    {
        $this->showEditModal = true;
        $this->Roomtype = $roomtype;
        $this->state = $roomtype->toArray();
        $this->view_room_type = $this->state['room_types'];
        $this->view_room_price = $this->state['price'];
        $this->dispatchBrowserEvent('show-form-detail');
    }

    public function comfirmUserRemoval($id)
    {
        $this->Roomtype_delete_id = $id;
        $this->dispatchBrowserEvent('show-form-delete');
    }
    public function delete()
    {
        $Roomtype = Room_type::findOrFail($this->Roomtype_delete_id);
        $Roomtype->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'ລົບສຳເລັດແລ້ວ']);
    }

    public function render()
    {

        $roomtypes = Room_type::query()
            ->where('room_types', 'like', '%' . $this->searchTerm . '%')
            ->latest()->paginate(5);



        return view('livewire.admin.room-tpye', [
            'roomtypes' => $roomtypes
        ]);
    }
}
