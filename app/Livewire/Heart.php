<?php
namespace App\Livewire;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Heart extends Component
{
    public Model $heartable;

    public function toggle()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->heartable->isHearted()) {
            $this->heartable->unheart();
        } else {
            $this->heartable->heart();
        }
    }

    public function render()
    {
        return view('livewire.heart');
    }
}
