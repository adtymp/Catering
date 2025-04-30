<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CekLogin implements ValidationRule
{
    protected $request;

    public function __construct($request){
        $this->request = $request;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $email = $this->request->input('email');
        $password = $this->request->input('password');
        $loginStatus = FALSE;

        $emailAdminCheck = User::where('email', $email)->count();
        if($emailAdminCheck > 0){
            $passwordAdmin = User::where('email', $email)->value('password');
            if(Hash::check($password, $passwordAdmin)){
                $loginStatus = TRUE;
            }
        }
        if($loginStatus){
            $dataAdmin = User::where('email', $email)->first();
            Session::put('loginStatus', TRUE);
            Session::put('dataAdmin', $dataAdmin);
        }else{
            $fail('Email atau Passowrd Salah!');
        }
    }
}
