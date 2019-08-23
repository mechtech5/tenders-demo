<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;

class CategoryController extends Controller
{
   		public function index(){
   			$categories = ExpenseCategory::all();
   			return  view('settings.categories.index',compact('categories'));
   		}
   		public function create(){
   			return  view('settings.categories.create');
   		} 
   		public function store(Request $request){
	   		$data = $request->validate([
	   			'name' 		=> 'required|string|max:100',
	   			'grp_code' 	=> 'required',
	   			'enabled'	=> 'required',
	   		]);
	   		ExpenseCategory::create($data);
	   		return redirect()->route('categories.index')->with('success','Category Inserted Successfully');
   		}
   		public function edit($id){
   			$category = ExpenseCategory::find($id);
   			return view('settings.categories.edit',compact('category'));
   			
   		}
   		public function update(Request $request, $id){
   			$data = $request->validate([
	   			'name' 		=> 'required|string|max:100',
	   			'grp_code' 	=> 'required',
	   			'enabled'	=> 'required',
	   		]);
	   		ExpenseCategory::where('id',$id)->update($data);
	   		return redirect()->route('categories.index')->with('success','Category Updated Successfully');
   		}
   		public function destroy($id){
   			
   			
   			ExpenseCategory::where('id',$id)->delete();
	   		return redirect()->back()->with('success','Category Deleted Successfully');
   		}
}
