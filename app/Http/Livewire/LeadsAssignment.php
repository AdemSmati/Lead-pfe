<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use App\Models\Status;
use App\Models\User;
use Livewire\Component;

class LeadsAssignment extends Component
{
    public $user ;
    public $lead;
    public $users; // liste des commerciaux
    public $leads; // liste des leads
    public $selectedUser; // commercial sélectionné
    public $selectedLeads = []; // leads sélectionnés
    public $status;

    protected $listeners = ['refreshComponent' => '$refresh'];



    public function render()
    {

        return view('livewire.leads-assignment', [
            'users' => $this->users,
            'leads' => $this->leads,
            'status'=> $this->status,
        ]);
    }
    public function mount(){
        $this->users = User::where('is_admin', '0')->get();
        $this->leads = Lead::all();
        $this->status=Status::all();
    }
    public function assign()
    {
        $this->validate([
            'lead.commercial_id' => 'required',
            'lead.raison_social' => 'required',
            'lead.current_status' => 'required',
            'lead.num_tel' => 'required|min:8|max:8',
            'lead.email' => 'required',
        ]);

        // Create a new lead instance and populate its fields
        $lead = new Lead();
        $lead->raison_social = $this->lead['raison_social'];
        $lead->current_status = $this->lead['current_status'];
        $lead->numéro_de_téléphone = $this->lead['num_tel'];
        $lead->email = $this->lead['email'];
        // Add the lead to the user's leads relationship
        $lead->user_id = $this->lead['commercial_id'];
        $lead->save();

        // Reset the form fields and emit a refresh event
        $this->reset('user', 'lead');
        $this->dispatchBrowserEvent('close_modal', ['id' => 'store_lead']);

        $this->emit('refreshComponent');
    }




}
