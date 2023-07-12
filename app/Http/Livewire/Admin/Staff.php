<?php

namespace App\Http\Livewire\Admin;

use App\Models\staff as ModelsStaff;
use App\Models\staff_type;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class Staff extends Component
{
    public $view_emp_name,$view_staff_type,$view_address,$view_contact_no,$view_salary;
    public $showEditModal = false;
    public $state = [];
    public $staff,$epm_delete_id;
    public $searchTerm =null;





    public function addNew(){
        $this ->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');
        $this->reset();
    }
    public function save_employees(){
        $data = Validator::make($this->state, [
            'emp_name' => 'required|unique:staff',
            'staff_type_id' => 'required',
            'address' => 'required',
            'contact_no' => ['required', 'min:8'],
            'salary' => 'required',
        ])->validate();

        ModelsStaff::create($data);

       $this->dispatchBrowserEvent('hide-form',['message' => 'Add Emproyees successfully!']);

    }

    public function showDetail($id){
        $eproyees = DB::table('staff')
            ->join('staff_types', 'staff_type_id', '=', 'staff_types.id')
            ->select('staff.*', 'staff_types.staff_type')
            ->where('staff.id','=',$id)
            ->get();

        foreach ($eproyees as $data) {
            $this->view_emp_name = $data->emp_name;
            $this->view_address = $data->address;
            $this->view_staff_type = $data->staff_type;
            $this->view_contact_no = $data->contact_no;
            $this->view_salary = $data->salary;
            // Do something with the extracted values
        }
        $this->dispatchBrowserEvent('show-form-detail');


    }






    public function edit($id)
    {
        $this->showEditModal = true;
        $this->staff = ModelsStaff::where('id', $id)->first();
        $this->state['emp_name'] = $this->staff->emp_name;
        $this->state['staff_type_id'] = $this->staff->staff_type_id;
        $this->state['address'] = $this->staff->address;
        $this->state['contact_no'] = $this->staff->contact_no;
        $this->state['salary'] = $this->staff->salary;

        $this->dispatchBrowserEvent('show-form');
    }
    public function update(){
        $data = Validator::make($this->state, [
            'emp_name' => 'required|unique:staff,emp_name,' . $this->staff->id,
            'staff_type_id' => 'required',
            'address' => 'required',
            'contact_no' => ['required', 'min:8'],
            'salary' => 'required',
        ])->validate();
        $this->staff->update($data);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Employyes Upadate successfully!']);
    }


    public function comfirmRemoval($id)
    {
        $this->staff = ModelsStaff::where('id', $id)->first();
        $this->epm_delete_id = $this->staff->id;
        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function delete(){
        $staff = ModelsStaff::findOrFail($this->Room_delete_id);
        $staff->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Employees delete successfully']);
    }



  






    public function render()
    {
        $staff_type = staff_type::all();
        // $eproyees = ModelsStaff::all();
        $eproyees = DB::table('staff')
            ->join('staff_types', 'staff_type_id', '=', 'staff_types.id')
            ->select('staff.*', 'staff_types.staff_type')
            ->where('staff.emp_name','like', '%'.$this->searchTerm.'%')
            ->get();
        return view('livewire.admin.staff',[
            'staff_type'=>$staff_type,
            'eproyees'=>$eproyees
        ]);
    }
}
