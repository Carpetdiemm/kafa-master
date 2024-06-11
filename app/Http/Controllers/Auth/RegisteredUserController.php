<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\parentModel;
use App\Models\studentModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        // $request->validate([
        //     'parents_name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'studentno' => ['required', 'integer', 'digits_between:1,10'],
        // ]);

        $validator = Validator::make($request->all(), [
            'parents_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'studentno' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = $request->role;

        if($role == 'parentStudent')
        {
            $user = User::create([
                'id' => $request->studentno,
                'name' => $request->parents_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'userrole'=>'parentStudent',
            ]);
        }
        
        if($role == 'teacher')
        {
            $user = User::create([
                'id' => $request->staffid,
                'name' => $request->teacher_name,
                'email' => $request->teacher_email,
                'password' => Hash::make($request->password),
                'userrole'=>'teacher',
            ]);
        }


        //student details
        $studentData = new studentModel;
        $studentData->student_ic =  $request->studentno;
        $studentData->student_name = $request->studentname;
        //student_address
        $studentData->student_address = $request->student_address;
        $studentData->save();

        //parent details
       
        $parentData = new parentModel;
        $parentData->parent_phone_numb = $request->phonenumber;
        $parentData->userID = $user->id;
        $parentData->student_id=$studentData->id;
        $parentData->save();
        
      

        event(new Registered($user));

        

        Auth::login($user);

        return redirect(route('dashboard', absolute: false))->with('success','Registration Success');
    }
}
