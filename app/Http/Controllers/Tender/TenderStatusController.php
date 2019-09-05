<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenderStatusController extends Controller
{
	public function index()
	{
		return view('tender.status.index');
	}

	public function create()
	{
		return view('tender.status.create');
	}

	public function store()
	{
		return request();
	}

	public function show()
	{
		return view('tender.status.show');
	}

	public function edit()
	{
		return view('tender.status.edit');
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