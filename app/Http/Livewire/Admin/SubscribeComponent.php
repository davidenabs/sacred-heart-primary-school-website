<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subscribe;
use Livewire\Component;

class SubscribeComponent extends Component
{
    public Subscribe $subscribe;
    public $name, $email, $status;

    public function mount($subscribe = null)
    {
        if ($subscribe) {
            $this->subscribe = $subscribe;
            $this->name = $subscribe->name;
            $this->email = $subscribe->email;
            $this->status = $subscribe->status;
        }
    }

    protected $rules = [
        'name' => 'nullable|min:6',
        'email' => 'nullable|email',
        'status' => 'nullable',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->status = '';
    }

    public function store()
    {

        $this->validate();

        try {
            $status = $this->status ?: true;

            Subscribe::create([
                'name' => $this->name,
                'email' => $this->email,
                'status' => $status,
            ]);

            $this->resetFields();

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'success', 'message' => 'Subscriber Created Successfully!!']
            );
        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something goes wrong!!']
            );
        }
    }

    public function update()
    {

        $this->validate();

        try {
            $this->subscribe->update([
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
            ]);

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'success', 'message' => 'Subscriber Updated Successfully!!']
            );
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something goes wrong!!']
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.subscribe-component');
    }
}
