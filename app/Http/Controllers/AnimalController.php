<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Characteristic;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $characteristics = Characteristic::all();
        $searchName = $request->input('name');
        $searchCharacteristic = $request->input('characteristic_id');

        if ($searchName && $searchCharacteristic) {
            $animals = Animal::where('name', 'like', '%' . $searchName . '%')
                ->where('characteristic_id', $searchCharacteristic)
                ->paginate();
        } elseif ($searchName) {
            $animals = Animal::where('name', 'like', '%' . $searchName . '%')->paginate();
        } elseif ($searchCharacteristic) {
            $animals = Animal::where('characteristic_id', $searchCharacteristic)->paginate();
        } else {
            $animals = Animal::paginate();
        }
        return View('/animals', compact(['animals', 'characteristics', 'searchName', 'searchCharacteristic']));
    }

    public function create()
    {
        $characteristics = Characteristic::all();
        $animals = Animal::all();
        $animals = new Animal();
        return View('/animals/form', compact(['animals', 'characteristics']));
    }

    //validasi input, array declaration
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|max:255',
            'characteristic_id' => 'required|int|gt:0',
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
        $lastPage = Animal::paginate()->lastPage();
        return redirect('/animals?page=' . $lastPage)->with('success', 'Data berhasil dibuat!');
    }

    public function edit($id)
    {
        $characteristics = Characteristic::all();
        $animals = Animal::find($id);
        session()->put('referer', url()->previous());
        return view('/animals/form', compact('animals', 'characteristics'));
    }

    public function update($id, Request $request)
    {
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
        return redirect(session()->get('referer'))->with('success', 'Data berhasil diupdate!');
        // return redirect('/animals');
    }

    public function destroy($id)
    {
        $animal = Animal::find($id);
        //dd($id);
        $animal->delete();
        return redirect('/animals')->with('success', 'Data berhasil dihapus!');
    }
}
