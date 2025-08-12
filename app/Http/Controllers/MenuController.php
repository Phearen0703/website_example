<?php

namespace App\Http\Controllers;
use validate;

use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    public function index(){
        $rows = Menu::whereNull('deleted_at')->get();
        return view('menus.index',compact('rows'));
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
            'description' => $request->description
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
            'description' => $request->description
        ]);
        return redirect()->route('menu_list');

    }
    
    public function destroy($id){
        $row = Menu::FindOrFail($id);
        $row->delete();

        return redirect()->route('menu_list');
    }

}
