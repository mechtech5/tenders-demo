<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenderTypeController extends Controller
{
	public function index()
	{
		return view('tender.type.index');
	}

	public function create()
	{
		return view('tender.type.create');
	}

	public function store()
	{
		return request();
	}

	public function show()
	{
		return view('tender.type.show');
	}

	public function edit()
	{
		return view('tender.type.edit');
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