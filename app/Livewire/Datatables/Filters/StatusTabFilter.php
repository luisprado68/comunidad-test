<?php

namespace App\Http\Livewire\Datatables\Filters;

use Livewire\Component;

class StatusTabFilter extends Component
{
    public $filterTabs;
    public $table;
    public $currentFilter="all";
    public $section;

    public function mount(){
        $this->resetFilters();
    }

    public function render()
    {
        return view('livewire.datatables.filters.status-tab-filter');
    }

    /**
     * Sets tab filter on tab selection
     */
    public function statusTabFilter($filter){
        session(['statusTabFilter' => $filter]);
        $this->currentFilter = $filter;
        //dump($filter);
        $this->emit('FilterTabChanged', $this->section);
    }

    /**
     * Reset tab selection to default
     */
    public function resetFilters(){
        session(['statusTabFilter' => ""]);
        $this->currentFilter = "all";
        $this->emit('FilterTabChanged');
    }
}
