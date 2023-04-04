<?php namespace App\Traits;

use \Illuminate\Http\Request;

trait ValidateEmailOrUsername
{
    public function isEmailOrUsername(Request $request): string
    {
        $input = $request->get('email');
        $validateInput = filter_var($input, FILTER_VALIDATE_EMAIL);

        return ($validateInput) ? 'email' : 'username';
    }
}
