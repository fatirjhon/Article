<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticsController extends Controller
{
    public function profile() {
	return view('statics/profile');
}

	public function home() {
	return view('statics/home');
}
}
