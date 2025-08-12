<?php

namespace App\Http\Controllers;
use validate;

use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    public function index()
    {
        $rows = Menu::whereNull('menus.deleted_at')
        ->leftJoin('users as u1', 'menus.created_by', '=', 'u1.id')
        ->leftJoin('users as u2', 'menus.updated_by', '=', 'u2.id')
        ->leftJoin('users as u3', 'menus.deleted_by', '=', 'u3.id')
        ->select(
            'menus.*',
            'u1.name as created_name',
            'u2.name as updated_name',
            'u3.name as deleted_name'
        )
        ->get();


        return view('menus.index', compact('rows'));
    }

    public function create(){
        return view('menus.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
        'name' => 'required|unique:menus|max:255',
        ]);
        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => getCurrentUser()->id,
            'created_at' => date('Y-m-d-H:i:s'),
        ]);

        return redirect()->route('menu_list');
    
    }

    public function edit(Request $request,$id){
        $row = Menu::find($id);
        return view('menus.edit',compact('row'));
    }

    public function update(Request $request,$id){

        $row = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:menus,name,' . $id . '|max:255|min:3',
            ]);

        $row->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => getCurrentUser()->id,
            'updated_at' => date('Y-m-d-H:i:s'),
        ]);
        return redirect()->route('menu_list');

    }
    
    public function destroy($id){
       $row = Menu::findOrFail($id);

        $row->update([
            'deleted_by' => auth()->id(),
        ]);

        $row->delete();

        return redirect()->route('menu_list');
    }

}
