<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest{
		public function authorize()
	{
		return true;
	}
		public function rules()
	{
		$id = $this->user;
		return [
		'email' => 'required|email|unique:users,email,'.$id,
		'password' => 'required|min: 8|confirmed',
		'first_name' => 'required',
		'last_name' => 'required'];
	}
}