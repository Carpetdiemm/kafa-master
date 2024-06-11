<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\parentModel;
use App\Models\studentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    //Custom Function
    public function viewUser()
    {
        $id=Auth::User()->id;
        $role=Auth::User()->userrole;

        if($role=='parentStudent')
        {
            $studentData = studentModel::where('student_ic','=',$id)->get();
            //dd($studentData);
            $parentData = parentModel::where('student_id','=',$studentData[0]->id)->get();

  
        return view('profile.view-profile',[
            'data'=>$studentData,
            'data2'=>$parentData
        ]);
        }

        else
        {
            $studentData = studentModel::all();
            return view('profile.view-profile',[
                'data'=>$studentData
            ]);
        }
        
    }

    public function update_profile_form(Request $request)
    {
        $role = $request->role;
        $id=Auth::User()->id;
        $studentData = studentModel::where('student_ic','=',$id)->get();
        //dd($studentData);
        $parentData = DB::table('parent_models')
        ->select('*', 'parent_models.id as pId')
        ->join('users','parent_models.userID','=','users.id')
        ->where('userID','=',$id)
        ->get();
        
        if($role == 'parent')
        {
          
            return view('profile.update_profile_form',[
                'data2'=>$parentData[0],
                'role'=>$role
            ]);
        }
        elseif($role == 'student'){
   
            return view('profile.update_profile_form',[
                'data'=>$studentData[0],
                'role'=>$role
            ]);
        }
        else{
            return ('Role Not Valid');
        }

        
    }

    public function update_profile_form_post(Request $request)
    {
        //Declare Variable
        $role = $request->input('role');
        $parentexactid = $request->input('id');
        $loggedId = Auth::User()->id;

        if($role == 'parent')
        {
            $parentUser = User::find($loggedId);
            $parentUser->name = $request->input('name');
            $parentUser->email = $request->input('email');
            $parentUser->save();

            $parentData = parentModel::find($parentexactid);
            $parentData->parent_phone_numb = $request->input('phonenumber');
            $parentData->save();
        
        }

        if ($role == 'student')
        {
            $request->validate([
                'password' => ['nullable','confirmed', Rules\Password::defaults()],
            ]);

            $studentModel = studentModel::where('student_ic','=',$loggedId)->first();
            $studentModel->student_name = $request->input('studentName');
            $studentModel->student_address = $request->input('student_address');
            // $studentModel->student_num = $request->input('studentNum');
            $studentModel->save();

            $User =  User::find($loggedId);
            $User->password = Hash::make($request->password);
            $User->save();
        }

        return redirect()->route('dashboard')->with('success','Info Update Successfull');

    }

    public function adminViewProfile(Request $request)
    {
        //student Details
        $studentIC = $request->input('student_ic');
        $studentData = studentModel::where('student_ic','=',$studentIC)->get();

        $parentData = DB::table('parent_models')
        ->select('*')
        ->join('users','parent_models.userID','=','users.id')
        ->where('users.id','=',$studentIC)
        ->get();
        

        return view('profile.admin.admin_view_profile',['data2'=>$parentData,'data'=>$studentData]);
    }

    public function adminUpdateProfile(Request $request)
    {
        $role = $request->input('role');
        $studentIC = $request->input('student_ic');

        if($role == 'student')
        {
            $studentData = studentModel::where('student_ic','=',$studentIC)->get();
            return view('profile.admin.admin_edit_profile',['studentData'=>$studentData[0],'role'=>$role]);
        }

        if($role == 'parent')
        {
            $parentData = DB::table('parent_models')
            ->select('*', 'parent_models.id as pId')
            ->join('users','parent_models.userID','=','users.id')
            ->where('userID','=',$studentIC)
            ->get();
     
            return view('profile.admin.admin_edit_profile',['parentData'=>$parentData[0],'role'=>$role]);
        }

    }

    public function adminupdateprofileformpost(Request $request)
    {
        
        $role = $request->input('role');
        //role : student
        //role : parent
        
        if($role == 'student')
        {
            $studentIC = $request->input('studentNum');
            $student =  studentModel::where('student_ic','=',$studentIC)->first();
            $student->student_name = $request->input('studentName');
            $student->student_address = $request->input('student_address');
            $student->save();

            return redirect()->route('dashboard')->with('success','Student Info Update Successfull');
        }

        if($role == 'parent')
        {
            $studentIC = $request->input('userID');
            $parent = parentModel::where('userID','=',$studentIC)->first();
            $parent->parent_phone_numb = $request->input('phonenumber');
            $parent->save();

            $parentUser = User::find($studentIC);
            $parentUser->name = $request->input('name');
            $parentUser->email = $request->input('email');
            $parentUser->save();

            return redirect()->route('dashboard')->with('success','Parent Info Update Successfull');

        }

        
    }

    public function destroyProfile($id)
    {
         // Find the user by ID and delete
      
        $parent = studentModel::where('student_ic','=',$id);
        $parent->forceDelete();

        $userd = User::find($id);
        $userd->forceDelete();



        // Redirect with a success message
        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    }

    
}
