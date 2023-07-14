<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Expenses as expense;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use function PHPSTORM_META\type;

class Expenses extends Component
{
    use WithPagination;

    public $type = 0, $amount, $des,$user_id;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $data = DB::table('expenses')
        ->join('users', 'user_id', '=', 'users.id')
        ->select('expenses.*', 'users.name')
        ->orderBy('id', 'desc')
        ->paginate(10);
        
        return view('livewire.admin.expenses',[
            'datas'=>$data
        ]);
    }
    protected $rules = [
        'amount' => 'required',
        'des' => 'required'

    ];
    protected $messages = [
        'amount.required' => 'ກະລຸນາປ້ອມຈຳນວນເງີນ!',
        'des.required' => 'ກະລຸນາໃສລາຍລະອຽດ!'

    ];

    public function resetfil(){
    
        $this->reset();
    }

    public function save()
    {
        $this->validate();
        
        $data = new expense();
        $data->amount = $this->amount;
        $data->des = $this->des;
        $data->type = $this->type;
        $data->user_id = auth()->user()->id;
        $data->save();
        $this->reset();
        $this->dispatchBrowserEvent('succuss', ['message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ']);
        
    }
}
