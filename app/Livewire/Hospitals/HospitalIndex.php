<?php

namespace App\Livewire\Hospitals;

use Livewire\Component;
use App\Models\Hospital;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class HospitalIndex extends Component
{
    use WithPagination;
    public $hospitals, $hospitalId;
    public $search,
        $sortBy = 'created_at',
        $sortDir = 'ASC',
        $perPage = 5;
    protected $listeners = ['deleteConfirmed' => 'delete'];
    public function sort($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
    }
    public function deleteConfirm($hospitalId)
    {
        $this->hospitalId = $hospitalId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->hospitals = Hospital::where('hospitalId', $this->hospitalId)->first();
        $this->hospitals->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Rumah Sakit berhasil dihapus!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('hospitals.index', navigate: true);
    }
    #[Title('Semua Rumah Sakit')]
    public function render()
    {
        if (Auth::user()->hasRole('Teknisi')) {
            abort(403);
        } else {
            return view('livewire.hospitals.hospital-index', [
                'rs' => Hospital::search($this->search)->paginate($this->perPage),
            ]);
        }
    }
}
