<?php

namespace App\Http\Controllers;
use Gate;
use App\User;
use App\Category;
use App\CompanyUser; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function approve(Request $request)
    {
        if(!Gate::allows('isAdmin')){
            abort(403, "Sorry, you can't do this action!");
        }

        $user = User::find($request->id);

        $user->status = "Approved";

        $user->save();

        return redirect()->route('home')->with('success', $user->type . ' Approved Successfully!');
    }

    public function unApprove(Request $request)
    {
        if(!Gate::allows('isAdmin')){
            abort(403, "Sorry, you can't do this action!");
        }

        $user = User::find($request->id);

        $user->status = "Unapproved";

        $user->save();

        return redirect()->route('home')->with('success', $user->type . ' Unapproved Successfully!');
    }

    public function addUserToCompanyView(User $user)
    {
        if(!Gate::allows('isAdmin')){
            abort(403, "Sorry, you can't do this action!");
        }

        return view('admin.addUserToCompany')->with('user', $user);
    }

    public function addUserToCompany(Request $request, User $user)
    {
        if(!Gate::allows('isAdmin')){
            abort(403, "Sorry, you can't do this action!");
        }

        $request->validate([
          'name' => ['required', 'string'],
          'email' => ['required', 'email', 'unique:users', 'unique:company_users'],
          'password' => ['required', 'string', 'min:8'],
        ]);

        $CompanyUser = $user->companyUser()->create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => md5($request['password']),
            ]);

            if($request->hasFile('display'))
            {
                $allowedfileExtension=['jpg', 'JPG' ,'png', 'PNG'];  

                $file = $request->file('display');

                $filename = $file->getClientOriginalName();

                $newname = str_replace(' ', '', $filename);
                                  
                $extension = $file->getClientOriginalExtension();
                 
                $check=in_array($extension,$allowedfileExtension);
             
                if($check)                 
                {
                    $finalname = time().$newname;

                    $file->move('uploads/display', $finalname); 
                     
                    $CompanyUser->display = 'uploads/display/'. $finalname;

                    $CompanyUser->save();
                }
            } 

        return redirect()->route('home')->with('success', 'User Added Successfully!');
    }

    public function removeUserFromCompany($id)
    {
        if(!Gate::allows('isAdmin')){
            abort(403, "Sorry, you can't do this action!");
        }

        // CompanyUser::find($id)->delete();
        CompanyUser::find($id)->forceDelete();

        return redirect()->route('home')->with('success', 'User Removed Successfully!');
    }

    public function editCompanyUser($id)
    {
        if(!Gate::allows('isAdmin')){
            abort(403, "Sorry, you can't do this action!");
        }

        return view('admin.editCompanyUser')->with('user', CompanyUser::find($id));
    }

    public function updateCompanyUser($id, Request $request)
    {
        if(!Gate::allows('isAdmin')){
            abort(403, "Sorry, you can't do this action!");
        }

        $request->validate([
          'name' => ['required', 'string'],
          'email' => ['required', 'email', 'unique:users', 'unique:company_users'],
          'password' => ['required', 'string', 'min:8'],
        ]);        

        $CompanyUser = CompanyUser::find($id);

        if (isset($request->username)) {
            $CompanyUser->username = $request->username;
        }

        if (isset($request->name)) {
            $CompanyUser->name = $request->name;
        }

        if (isset($request->email)) {
            $CompanyUser->email = $request->email;
        }
        if (isset($request->password)) {
            $CompanyUser->password = md5($request['password']);
        }

        if($request->hasFile('display'))
        {
            $allowedfileExtension=['jpg', 'JPG' ,'png', 'PNG'];  

            $file = $request->file('display');

            $filename = $file->getClientOriginalName();

            $newname = str_replace(' ', '', $filename);
                              
            $extension = $file->getClientOriginalExtension();
             
            $check=in_array($extension,$allowedfileExtension);
         
            if($check)                 
            {
                $finalname = time().$newname;

                $file->move('uploads/display', $finalname); 
                 
                $CompanyUser->display = 'uploads/display/'. $finalname;
            }
        } 

        $CompanyUser->save();

        return redirect()->route('home')->with('success', 'User Updated Successfully!');
    }

    public function delete(User $user)
    {
        if(!Gate::allows('isAdmin')){
            abort(403, "Sorry, you can't do this action!");
        }

        $user->delete();
        // $user->forceDelete();

        return redirect()->route('home')->with('success', $user->type . ' Deleted Successfully!');
    }
}