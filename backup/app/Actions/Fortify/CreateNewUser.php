<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;



class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $myrid = Str::random(5);


        if ($input['sponcerid']) {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'regex:/^\S*$/u', 'max:25', 'unique:users'],
                'role' => ['required', 'string', 'max:255'],
                'phone' => ['required','max:255','regex:/(0)[0-9]/','not_regex:/[a-z]/','min:12'],
                'sponcerid' => ['exists:users,myrefferalcode',  'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();



            return User::create([
                'name' => $input['name'],
                'username' => $input['username'],
                'phone' => $input['phone'],
                'myrefferalcode' => 'dbdt' . $input['username'],
                'status' => '0',
                'override_level' => '0',
                'role' => $input['role'],
                'sponcerid' => $input['sponcerid'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        } else {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'regex:/^\S*$/u', 'max:25'],
                'phone' => ['required','max:255','regex:/(0)[0-9]/','not_regex:/[a-z]/','min:12'],
                'role' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();
            return User::create([
                'name' => $input['name'],
                'username' => $input['username'],
                'myrefferalcode' => 'dbdt' . $input['username'],
                'phone' => $input['phone'],
                'status' => '0',
                'override_level' => '0',
                'role' => $input['role'],
                'sponcerid' => 'dbdtcenter12',
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        }
    }
}
