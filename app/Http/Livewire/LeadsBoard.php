<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use App\Models\Status;
use Asantibanez\LivewireStatusBoard\LivewireStatusBoard;
use Illuminate\Support\Collection;
use Livewire\Component;

class LeadsBoard extends LivewireStatusBoard
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public $lead;
        public function render()
        {
            $status=Status::all();
            return parent::render()->with(['status' => $status]); // TODO: Change the autogenerated stub
        }

    public function storeLead(){
        $this->validate([
            'lead.raison_social' => 'required',
            'lead.current_status' => 'required',
            'lead.numéro_de_téléphone' => 'required',
            'lead.email' => 'required',

        ]);

        $lead= new Lead();
        $lead->raison_social=$this->lead['raison_social'];
        $lead->current_status=$this->lead['current_status'];
        $lead->numéro_de_téléphone=$this->lead['numéro_de_téléphone'];
        $lead->email=$this->lead['email'];


        $lead->save();

        $this->dispatchBrowserEvent('close_modal', ['id' => 'store_lead']);
        $this->reset('lead');
        $this->emit('refreshComponent');

    }


    public function onStatusChanged($recordId, $statusId, $fromOrderedIds, $toOrderedIds)
    {
        $lead=Lead::find($recordId);
        $lead->current_status=$statusId;
        $lead->save();


        $this->emit('refreshComponent');
    }

    public function onRecordClick($recordId)
    {
        dd(1);
    }
    public function statuses() : Collection
    {
        $statuss=Status::all();
        $collection=new Collection();
        foreach ($statuss as $status){
            $collection->push([
                'id'=>$status->id,
                'title'=>$status->nom_status,
            ]);
        }
        return $collection;
    }

    public function records() : Collection
    {
        $leads=Lead::all();
        $collection=new Collection();
        foreach ($leads as $lead){
            $collection->push([
                'id' => $lead->id,
                'title' => $lead->raison_social,
                'status' => $lead->current_status,
                'num_tel' => $lead->numéro_de_téléphone,
                'email' => $lead->email,
            ]);
        }
        return $collection;
    }

    public function test(){
        dd('test' );
    }
}
