<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Added..........
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change_password_method()
    {
        return view('update_password');
    }

    public function update_password_method(Request $request)
    {
          $hash_password = Auth::user()->password;

          $old_pasword = $request->old_pasword;
         $new_password = $request->new_password;
         $password_confirmation = $request->password_confirmation;

        if($new_password == $password_confirmation)
        {
            if(Hash::check($old_pasword,$hash_password))
            {
                $user_id = Auth::id();

                $user = User::findOrFail($user_id);
                $user->password = Hash::make($new_password);

                if($user->save())
                {
                    $message = "Password chenaged successfully !!";
                    $notification_array = array(
                        'message' => $message,
                        'alert-type' =>'success'
                    );
                    return redirect()->route('index')->with($notification_array);
                }


            }
            else{
//                echo 'Password not HASHING match';
                $message = "Password Not Matched !!";
                $notification_array = array(
                    'message' => $message,
                    'alert-type' =>'error'
                );
                return redirect()->back()->with($notification_array);
            }
        }
        else{
            // Password not match
//            echo "Password not confirm";
            $message = "Password Not confirmed !!";
            $notification_array = array(
                'message' => $message,
                'alert-type' =>'warning'
            );
            return redirect()->back()->with($notification_array);

        }

//        dd('update password');
    }





}
