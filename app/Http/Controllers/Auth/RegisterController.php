<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Recruiter;
use App\User;
use App\UserRole;
use App\Worker;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $goToLogIn = RouteServiceProvider::LOGIN;

    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'alpha','min:4'],
            'surname' => ['required', 'alpha','min:4'],
          //  'userRoleSlug' => ['required', 'string'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data, $userRole)
    {
        try {
            return User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_role_id' => $userRole->id,
                'slug' => uniqid(),
                'role' => $userRole->role,
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    protected function createWorker(array $data, $user)
    {
        try {
           // $name = explode(" ", $data['name']);
            return Worker::create([
                'name' => ucfirst($data['name']),
                'surname' => ucfirst($data['surname']),
                'user_id' => $user->id,
                'slug' => uniqid(),
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    protected function createRecruiter(array $data, $user)
    {
        try {
            $name = explode(" ", $data['name']);
            return Recruiter::create([
                'name' => ucfirst($name[0]),
                'surname' => ucfirst($name[1]),
                'user_id' => $user->id,
                'slug' => uniqid(),
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    protected function workerResponse($user, $worker)
    {
        if ($user == null && $worker == null) {
            flash(
                'Failed to create a new user,Please try again.'
            )->error();
            return back();
        } else if ($user != null && $worker != null) {
            flash('Your account was created successfully')->success();
            return redirect($this->goToLogIn);
        } else {
            // return redirect('register');
        }
    }
}
