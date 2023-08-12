<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Notifications\User\NewUserCreated;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Users extends Component
{

    public User $user;
    public $name, $email, $phone, $role = 'ADM', $type;

    public function mount($type, $user = null)
    {
        $this->type = $type;

        if ($type == 'admin') {
            $this->role = 'ADM';
        } elseif ($type == 'writer') {
            $this->role = 'WRT';
        } else {
            $this->role = 'USR';
        }

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->role = $user->role;
        }

    }

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|unique:users,phone',
    ];

    public function store()
    {
        $this->validate();

        $generatePassword = Str::random(8);
        $password = password_hash($generatePassword, PASSWORD_DEFAULT);

        try {
            $user = User::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' =>$this->email,
                'role' => $this->role,
                'password' => $password
            ]);

            $user->writerInfo()->create();

            $this->resetFields();

            session()->flash('success', 'Created Successfully!!');

            $data  = [
                'password' => $generatePassword,
                'role' => $user->role,
            ];
            // send a mail with the generated password
            $user->notify(new NewUserCreated($data));

            // notify the user
            $this->dispatchBrowserEvent('userCreated', ['data' => $generatePassword] );

        } catch (\Throwable $th) {
            dd($th);
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'success', 'message' => 'Soemthing went wrong!']
            );
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
        ]);

        try {
            $this->user->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' =>$this->email,
                'role' => $this->role,
            ]);

            session()->flash('success', 'Updated Successfully!!');

            // send a mail with the generated password

            return to_route('admin.users.index', $this->type);

        } catch (\Throwable $th) {
            dd($th);
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'success', 'message' => 'Soemthing went wrong!']
            );
        }
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
    }

    public function render()
    {
        return view('livewire.admin.users');
    }
}
