<?php

namespace App\Livewire;


use App\Models\Emp;
use App\Models\Classe;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Jobs\SendMessagesToProfs;
use App\Jobs\SendMessagesToClasses;
use App\Jobs\SendMessagesToParents;
use App\Services\WhatsappApiService;
use App\Jobs\SendMessagesToEmployees;

class Whatsapp extends Component
{
    use WithFileUploads;

    public $Classes = [];
    public $cls ;

    #[Rule('required|image',as: ' ')] 
    public $phototemp;

    public $photo;

    #[Rule('required',as: ' ')] 
    public $msg;


    public $profs;
    public $emps;
    public $parent;

    function mount() 
    {
        $this->Classes = Classe::all('id', 'nom');
    }

    function send() 
    {
        $this->validate();

        if (!($this->cls or $this->emps or $this->profs or $this->parent)) 
        {
            $magfr = 'Veuillez choisir une option';
            $magar = 'الرجاء اختيار خيار';

            $msg = app()->getLocale() == 'fr' ? $magfr : $magar;
            
            $this->addError('msg',  $msg);
            return;
        }

       if ($this->emps) 
       {
            $this->emp();
       }

       if ($this->profs) 
       {
           $this->prof();
       }

       if ($this->parent) 
        {
            $this->parent();
        }
        
        elseif ($this->cls) 
        {
            $this->cls($this->cls);
        }


    }


    function emp() 
    {
      //  SendMessagesToEmployees::dispatch($this->msg);

      $create = new WhatsappApiService(); // Ensure this service is properly imported
      $phone = "22236411579";
      $msg= $this->msg;

        // Get the binary content of the uploaded file
        $fileContents = file_get_contents($this->phototemp->getRealPath());


      $base64Image = base64_encode($fileContents);
    //  dd($base64Image);

      
      $ids = $create->sendCurlImage($phone, $base64Image);


    //  dd($ids);




     $id = $create->sendCurlRequestFirst($phone, $msg);
     
     $emps = Emp::all();

     foreach ($emps as $emp) {
         if ($emp->tel2 === null) {
             continue;
         }

         $code = '222'; // Modify as needed
         $phone = $code . $emp->tel2;

       //  dd($phone, $id);

         $create->sendCurlRequestForward($phone, $ids);  // Assuming sendCurlRequest is a globally available function.


     }

      
    }

    function prof() 
    {
        SendMessagesToProfs::dispatch($this->msg);
    }

    function parent() 
    {
        SendMessagesToParents::dispatch($this->msg);
    }

    function cls($cls) 
    {
        SendMessagesToClasses::dispatch($this->msg,$cls); 
    }


    public function render()
    {
        return view('livewire.whatsapp');
    }
}
