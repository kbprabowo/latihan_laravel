<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Validator;

class ListController extends Controller
{
    public function index()
    {
        $animals = Animal::all();
        return View('list', compact(['animals']));
    }

    public function create()
    {
        return View('create');
    }

    //validasi input, array declaration
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return redirect('/create')
                ->withInput()
                ->withErrors($validator);
        }
        $animal = Animal::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return redirect('list');
    }

    public function edit($id)
    {
        $animals = Animal::find($id);
        //dd($animals);
        return View('edit', compact(['animals']));
    }

    public function update($id, Request $request)
    {
        $animals = Animal::find($id);
        $animals->update($request->except(['_token', 'submit']));
        return redirect('list');
    }

    public function destroy($id)
    {
        $animal = Animal::find($id);
        //dd($id);
        $animal->delete();
        return redirect('list');
    }
}
