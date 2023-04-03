<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Characteristic;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::paginate(10);
        // $animals = Animal::simplePaginate(5);
        return View('/animals', compact(['animals']));
    }

    public function create()
    {
        $characteristics = Characteristic::all();
        return View('/animals/create', compact(['characteristics']));
    }

    //validasi input, array declaration
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|max:255',
            'characteristic_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return redirect('animals/create')
                ->withInput()
                ->withErrors($validator);
        }
        $animal = Animal::create([
            'name' => $request->name,
            'characteristic_id' => $request->characteristic_id,
        ]);
        return redirect('/animals');
    }

    public function edit($id)
    {
        $characteristics = Characteristic::all();
        $animals = Animal::find($id);
        //dd($animals);
        return view('/animals/edit', compact('animals', 'characteristics'));
    }

    public function update($id, Request $request)
    {
        //$animals = Animal::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'characteristic_id' => 'required|int|gt:0',
        ]);
        if ($validator->fails()) {
            return redirect('animals/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        }

        Animal::where('id', $id)->update(['name' => $request['name'], 'characteristic_id' => $request['characteristic_id']]);

        return redirect('/animals');
    }

    public function destroy($id)
    {
        $animal = Animal::find($id);
        //dd($id);
        $animal->delete();
        return redirect('/animals');
    }
}
