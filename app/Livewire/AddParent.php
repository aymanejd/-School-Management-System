<?php

namespace App\Livewire;

use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rule;


class AddParent extends Component
{
    public $Email ;
    public $successMessage;
    public $currentStep = 1;
    // // Father_INPUTS
    public $Password;
     public $Name_Father;
   public $National_ID_Father;
   public $Passport_ID_Father ;
   public $Phone_Father ;
   public $Job_Father ,$updateMode = false,$show_table = true , $Parent_id ;
   public $Nationality_Father_id;
    public $Address_Father ;
    public $Religion_Father_id;

    public $Name_Mother;
    public $Job_Mother;
    public $Job_Mother_en;
    public $Name_Mother_en;
    public $National_ID_Mother;
    public $Passport_ID_Mother;
    public $Phone_Mother;
    public $Nationality_Mother_id;
    public $Address_Mother;
    public $Religion_Mother_id;

    protected $rules = [
        'Email' => 'required|email|unique:my__parents',
        'National_ID_Father' => 'required|string|min:10|unique:my__parents|max:10|regex:/[0-9]{9}/',
        'Passport_ID_Father' => 'min:10|max:10',
        'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        'Passport_ID_Mother' => 'min:10|max:10|unique:my__parents',
        'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
    ];
   
    // public function updated($propertyName)
    // { 
    //         $this->validateOnly($propertyName);
    //     }
    public function render()

    {
        $Nationalities = Nationalitie::all();
        $Religions = Religion::all();
        return view('livewire.add-parent', [
            'currentStep' => $this->currentStep,
            'Nationalities' => $Nationalities,
            'Religions' => $Religions,
            'my_parents' => My_Parent::all()

        ]);
    }
  
    public function firstStepSubmit()
    {
           $this->validate([
                'Email' => 'required|unique:my__parents,Email',
                'Password' => 'required',
                'Name_Father' => 'required',
                'Job_Father' => 'required',
                'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,' ,
                'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,' ,
                'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'Nationality_Father_id' => 'required',
                'Religion_Father_id' => 'required',
                'Address_Father' => 'required',
            ]);

        $this->currentStep = 2;
    }
    public function showformadd(){
        $this->show_table = false;
    }
    public function secondStepSubmit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' ,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' ,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Nationality_Mother_id' => 'required|unique:my__parents',
            'Religion_Mother_id' => 'required|unique:my__parents',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }
    public function submitForm(){

            $My_Parent = new My_Parent();
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            $My_Parent->Name_Father = $this->Name_Father;
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Job_Father = $this->Job_Father ;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Nationality_Father_id = $this->Nationality_Father_id;
            $My_Parent->Religion_Father_id = $this->Religion_Father_id;
            $My_Parent->Address_Father = $this->Address_Father;

            // Mother_INPUTS
            $My_Parent->Name_Mother = $this->Name_Mother ;
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            $My_Parent->Job_Mother = $this->Job_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Nationality_Mother_id = $this->Nationality_Mother_id;
            $My_Parent->Religion_Mother_id = $this->Religion_Mother_id;
            $My_Parent->Address_Mother = $this->Address_Mother;

            $My_Parent->save();
            $this->successMessage = trans('The data has been saved successfully');
            $this->clearForm();
            $this->currentStep = 1;
        

       



    }
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $My_Parent = My_Parent::where('id',$id)->first();
        $this->Parent_id = $id;
        $this->Email = $My_Parent->Email;
        $this->Password = $My_Parent->Password;
        $this->Name_Father = $My_Parent->Name_Father;
        $this->Job_Father = $My_Parent->Job_Father;
        $this->National_ID_Father =$My_Parent->National_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->Nationality_Father_id;
        $this->Address_Father =$My_Parent->Address_Father;
        $this->Religion_Father_id =$My_Parent->Religion_Father_id;

        $this->Name_Mother = $My_Parent->Name_Mother;
        
        $this->Job_Mother = $My_Parent->Job_Mother;
        $this->National_ID_Mother =$My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->Nationality_Mother_id;
        $this->Address_Mother =$My_Parent->Address_Mother;
        $this->Religion_Mother_id =$My_Parent->Religion_Mother_id;
    }

    //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        $this->validate([
            'Email' => [
                'required',
                Rule::unique('my__parents', 'Email')->ignore($this->Parent_id),
            ],
            'Password' => 'required',
            'Name_Father' => 'required',
            'Job_Father' => 'required',
            'National_ID_Father' => ['required', Rule::unique('my__parents', 'National_ID_Father')->ignore($this->Parent_id)],
            'Passport_ID_Father' => ['required', Rule::unique('my__parents', 'Passport_ID_Father')->ignore($this->Parent_id)],
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
    
        $this->updateMode = true;
        $this->currentStep = 2;
    }
    
    
    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'National_ID_Mother' => ['required', Rule::unique('my__parents', 'National_ID_Mother')->ignore($this->Parent_id)],
            'Passport_ID_Mother' => ['required', Rule::unique('my__parents', 'Passport_ID_Mother')->ignore($this->Parent_id)],
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Nationality_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
    
        $this->updateMode = true;
        $this->currentStep = 3;
    }
    

    public function submitForm_edit(){

        if ($this->Parent_id){
            $parent = My_Parent::find($this->Parent_id);
            
            $parent->Email = $this->Email;
            $parent->Password = Hash::make($this->Password);
            $parent->Name_Father = $this->Name_Father;
            $parent->National_ID_Father = $this->National_ID_Father;
            $parent->Passport_ID_Father = $this->Passport_ID_Father;
            $parent->Phone_Father = $this->Phone_Father;
            $parent->Job_Father = $this->Job_Father ;
            $parent->Passport_ID_Father = $this->Passport_ID_Father;
            $parent->Nationality_Father_id = $this->Nationality_Father_id;
            $parent->Religion_Father_id = $this->Religion_Father_id;
            $parent->Address_Father = $this->Address_Father;

            $parent->Name_Mother = $this->Name_Mother ;
            $parent->National_ID_Mother = $this->National_ID_Mother;
            $parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $parent->Phone_Mother = $this->Phone_Mother;
            $parent->Job_Mother = $this->Job_Mother;
            $parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $parent->Nationality_Mother_id = $this->Nationality_Mother_id;
            $parent->Religion_Mother_id = $this->Religion_Mother_id;
            $parent->Address_Mother = $this->Address_Mother;
            $parent->save();

        }

        return redirect()->to('/add_parent');
    }
    public function delete($id){
        My_Parent::findOrFail($id)->delete();
        return redirect()->to('/add_parent');
    }
}