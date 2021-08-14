<?php

namespace App\Http\Livewire;

use App\Http\Requests\ExpenseRequest;
use Livewire\Component;
use App\Models\Expens;
use App\Models\income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class Expense extends Component
{
    
    public $name;
    public $amount;
    public $date;
    public $expense;
    public $income;
    public $modal;
    public $module;
    public $description,$selected_id;
    public function store(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'description'=>'required'
        ]);
       
        if($this->income=="income")
        {
            $expense = New income;
            $expense->name =$this->name;
            $expense->amount = $this->amount;
            $expense->date =$this->date;  
            $expense->description =$this->description;
            $expense->user_id =Auth::user()->id;
            $expense->save();
           
        }
        else
        $expense = New Expens;
        $expense->name =$this->name;
        $expense->amount = $this->amount;
        $expense->date =$this->date;  
        $expense->description =$this->description;
        $expense->user_id =Auth::user()->id;
        $expense->save();
        $this->reset();
        
    }
    public function editincome($id)
    {
    $editdata = income::findOrFail($id);
    $this->selected_id = $id;
    $this->name = $editdata->name;
    $this->amount = $editdata->amount;
    $this->modal = true;
    $this->module = false;

    
    }
    // edit function for expenses
    public function editexpenses($id)
    {
    $editdata = Expens::findOrFail($id);
    $this->selected_id = $id;
    $this->name = $editdata->name;
    $this->amount = $editdata->amount;
    $this->modal = true;
    $this->module = true;

    }
    // update income
    public function updateincome()
    {
        if ($this->selected_id) {
            $record = income::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'amount' => $this->amount
            ]);
            
            $this->modal = false;
            // $this->resetInput();
            // $this->updateMode = false;
        }
    }
    // update expense
    public function updateexpesne()
    {
        if ($this->selected_id) {
            $record = Expens::find($this->selected_id);
            $record->name=$this->name;
            $record->amount=$this->amount;  
            $record->save();
            $this->modal = false;
            // $this->resetInput();
            // $this->updateMode = false;
        }
    }
    // delete for income
    public function delete($id)
    {
        if ($id) {
            $record = income::where('id', $id);
            $record->delete();
        }
    }
    // delete for expense
    public function deletee($id)
    {
        if ($id) {
            $record = Expens::where('id', $id);
            $record->delete();
        }
    }
    public function render()
    {
       $exp= $this->expenses = Expens::where('user_id',Auth::user()->id)->get();
       $inc= $this->incomes = income::where('user_id',Auth::user()->id)->get();
       $addincomes =income::where('user_id',Auth::user()->id)->get('amount')->sum('amount');
       $addexpenses = Expens::where('user_id',Auth::user()->id)->get('amount')->sum('amount');
       $restamount = $addincomes -$addexpenses;
        return view('dashboard',['exp'=>$exp,'inc'=>$inc,'addincomes'=>$addincomes,'addexpenses'=>$addexpenses,'restamount'=>$restamount]);
    }
}
