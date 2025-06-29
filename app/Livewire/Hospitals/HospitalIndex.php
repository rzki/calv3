<?php

namespace App\Livewire\Hospitals;

use App\Exports\HospitalDeviceExport;
use App\Models\User;
use Livewire\Component;
use App\Models\Hospital;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
            'title' => 'Data Pelanggan berhasil dihapus!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('hospitals.index', navigate: true);
    }
    public function export()
    {
        $filename = 'CAL_CUSTOMER_'.date('d/m/Y').'.xlsx';
        $query = Hospital::query();
        $query->select(['name', 'phone_number', 'address'])->search($this->search)->paginate($this->perPage);
        return Excel::download(new HospitalDeviceExport($query), $filename);
    }
    #[Title('Semua Data Pelanggan')]
    public function render(User $user)
    {
        if ($this->authorize('devices', $user)) {
            return view('livewire.hospitals.hospital-index', [
                'rs' => Hospital::search($this->search)->paginate($this->perPage),
            ]);
        } else {
            return view('livewire.hospitals.hospital-index', [
                'rs' => Hospital::search($this->search)->paginate($this->perPage),
            ]);;
        }
    }
}
