<?php
namespace App\Http\Controllers;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/

public function index(){}

/* -----------------------------------------------------------------------------------------
@Description: Function for destroy
@input: id
@Output: delete counrty
-------------------------------------------------------------------------------------------- */
public function create(){}

/* -----------------------------------------------------------------------------------------
@Description: Function for destroy
@input: id
@Output: delete counrty
-------------------------------------------------------------------------------------------- */
public function store(Request $request){}

/* -----------------------------------------------------------------------------------------
@Description: Function for destroy
@input: id
@Output: delete counrty
-------------------------------------------------------------------------------------------- */
public function show(Permission $permission){}

/* -----------------------------------------------------------------------------------------
@Description: Function for destroy
@input: id
@Output: delete counrty
-------------------------------------------------------------------------------------------- */
public function edit(Permission $permission){}

/* -----------------------------------------------------------------------------------------
@Description: Function for update country data
@input: country
@Output: Update country data
-------------------------------------------------------------------------------------------- */
public function update(Request $request, Permission $permission){}

/* -----------------------------------------------------------------------------------------
@Description: Function for destroy
@input: id
@Output: delete counrty
-------------------------------------------------------------------------------------------- */
public function destroy(Permission $permission){}
}