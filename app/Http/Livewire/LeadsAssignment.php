<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use App\Models\Status;
use App\Models\User;
use Livewire\Component;

class LeadsAssignment extends Component
{
    public $userr = [
        'name' => '',

    ];
    public $lead = [
        'raison_social' => '',
        'current_status' => '',
        'numéro_de_téléphone' => '',
        'email' => '',
    ];
    public $users; // liste des commerciaux
    public $leads; // liste des leads
    public $selectedUser; // commercial sélectionné
    public $selectedLeads = []; // leads sélectionnés
    public $status;
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
    public function assignLead(){
        $this->validate([
            'lead.raison_social' => 'required',
            'lead.current_status' => 'required',
            'lead.numéro_de_téléphone' => 'required',
            'lead.email' => 'required',
        ]);

        $lead = new Lead();

        $lead->raison_social = $this->lead['raison_social'];
        $lead->current_status = $this->lead['current_status'];
        $lead->numéro_de_téléphone = $this->lead['numéro_de_téléphone'];
        $lead->email = $this->lead['email'];

        // Add the lead to the non-admin users
        $user = User::where('name', $this->userr['name'])->firstOrFail();
        $user->leads()->save($lead);

        $this->dispatchBrowserEvent('close_modal', ['id' => 'assignLead']);
        $this->reset('lead');
        $this->emit('refreshComponent');
    }



}
