<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Component
{
    public $name, $permission;

    protected $rules = [
        'name' => 'required|unique:roles,name',
        'permission' => 'required',
    ];

    public function store()
    {

        $this->validate();

        try {
            $role = Role::create(['name' => $this->name]);
            $role->syncPermissions($this->permission);

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'success', 'message' => 'Role Added Successfully!']
            );
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something goes wrong!!']
            );
        }
    }

    public function render()
    {
        $permission = Permission::get();
        return view('livewire.admin.role-permission', ['ot_permission' => $permission]);
    }
}
