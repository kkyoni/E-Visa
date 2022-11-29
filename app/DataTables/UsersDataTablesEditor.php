<?php

namespace App\DataTables;

use App\User;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;
use Illuminate\Database\Eloquent\Model;

class UsersDataTablesEditor extends DataTablesEditor
{
    protected $model = User::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'email' => 'required|email|unique:users',
            'name'  => 'required',
        ];
    }

    /**
     * Get edit action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function editRules(Model $model)
    {
        return [
            'email' => 'required|required|email|' . Rule::unique($model->getTable())->ignore($model->getKey()),
            'name'  => 'required|required',
        ];
    }

    /**
     * Get remove action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function removeRules(Model $model)
    {
        return [];
    }
}
