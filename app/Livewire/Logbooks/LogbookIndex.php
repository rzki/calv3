<?php

namespace App\Livewire\Logbooks;

use App\Models\LogBook;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class LogbookIndex extends Component
{
    use WithPagination;
    public $logbooks, $logId;
    public $search, $sortBy='created_at', $sortDir='ASC', $perPage=5;
    protected $listeners = ['deleteConfirmed' => 'delete'];
    public function sort($sortByField)
    {
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
    }

    public function deleteConfirm($logId){
        $this->logId = $logId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->logbooks = LogBook::where('logId', $this->logId)->first();
        $this->logbooks->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('logbooks.index', navigate:true);
    }
    #[Title('Log Book')]
    public function render()
    {
        // $logbook = LogBook::search($this->search)
        //     ->paginate($this->perPage);
        // dd($logbook);
        return view('livewire.logbooks.logbook-index',[
            'logInv' => LogBook::search($this->search)
            ->paginate($this->perPage)
        ]);
    }
}
