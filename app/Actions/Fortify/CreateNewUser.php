<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;


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
                'user_role' => ['required', 'string', 'max:255'],
                'phone' => ['required','max:255'],
                'sponcerid' => ['exists:users,myrefferalcode,status,1',  'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ], ['sponcerid.exists' => 'Sorry, This sponsor ID is not valid or inactive. Please try with different one with active account referral code, Thank You.']
            )->validate();



        $sponcer = DB::table('users')->where('myrefferalcode', $input['sponcerid'])->first();
        if($sponcer->user_role==='leader'){
            $leader_id = $sponcer->id;
        }
        else{
            $leader_id = $sponcer->leader_id;
        }


            return User::create([
                'name' => $input['name'],
                'username' => $input['username'],
                'phone' => $input['phone'],
                'myrefferalcode' => 'dbdt' . $input['username'],
                'status' => '0',
                'override_level' => '0',
                'role' => $input['role'],
                'user_role' => $input['user_role'],
                'sponcerid' => $input['sponcerid'],
                'leader_id' => $leader_id,
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        } else {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'regex:/^\S*$/u', 'max:25'],
                'phone' => ['required','max:255'],
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
                'user_role' => $input['user_role'],
                'sponcerid' => 'dbdtcenter12',
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        }
    }
}
