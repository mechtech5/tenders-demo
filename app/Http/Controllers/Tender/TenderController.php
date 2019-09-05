<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenderController extends Controller
{
	public function index()
	{
		return view('tender.master.index');
	}

	public function create()
	{
		return view('tender.master.create');
	}

	public function store()
	{
		return request();
	}

	public function show()
	{
		return view('tender.master.show');
	}

	public function edit()
	{
		return view('tender.master.edit');
	}

	public function update()
	{
		return request();
	}

	public function destroy()
	{
		//
	}
}