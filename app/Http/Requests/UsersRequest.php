<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name'              => ['required'],
			'email'             => ['required', 'email', 'max:254'],
			'email_verified_at' => ['nullable', 'date'],
			'password'          => ['required'],
			'remember_token'    => ['nullable'],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
