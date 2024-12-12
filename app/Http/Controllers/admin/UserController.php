<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\helper;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('search');
        $users = User::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', "%{$query}%")
                                ->orWhere('email', 'like', "%{$query}%");
        })->orderBy('id', 'desc')->get();

        return view('admin.users.index', [
            'title' => 'User Management',
            'users' => $users,
        ]);
    }

    public function create()
    {
        $title = "User Add";
        return view('admin.users.create',compact('title'));
    }


    public function store(Request $request)
    {
        // $testhelperfunction = getdata($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        if ($request['image']!="") {
            $file = $request->file('image');
            $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $extensions = ['jpg', 'jpeg', 'png', 'JPEG', 'PNG','JPG','svg'];
            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return back()->withInput()->withErrors($status);
            }
            $request->file('image')->move("admin/uploads/users", $name);
            $user->image = 'admin/uploads/users/'.$name;
        }

        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $title = "User Edit";
        $user = User::find($id);
        return view('admin.users.edit',compact('title','user'));
    }


    public function update(Request $request, string $id)
    {
        $user = User::where('id',$id)->first();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            $file = $request->file('image');
            $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $extensions = ['jpg', 'jpeg', 'png', 'svg'];
            if (!in_array($file->getClientOriginalExtension(), $extensions)) {
                return back()->withInput()->withErrors(['image' => 'File type is not allowed. Please upload a valid image!']);
            }
            $file->move(public_path('admin/uploads/users'), $name);
            $user->image = 'admin/uploads/users/' . $name;
        }
        $user->update();
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }


    public function destroy(string $id)
    {
        //
    }
    public function forgetPassword()
    {
        return view('admin.dashbord.forget');
    }
    public function forgetPasswordSendMail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email', // The email should exist in the users table
        ]);

        $user = User::where('email',$request->email)->first();
        $data = [
            'user' => $user,
            'planName' => $user->name,
        ];
        $to_name = ($user->first_name ?? '') . ' ' . ($user->last_name ?? '');
        $to_email=$user->email;
        Mail::send('admin.mail.forgetpasswordmail', $data, function ($message) use ($to_name, $to_email) {
           $message->to($to_email, $to_name)->subject('Send successfully  Forget  Mail');
           $message->from('contact@test.com','test');
        });

        return redirect()->route('forgetPassword')->with('success', 'User created successfully.');

    }
    public function updatePasswordBladeFile($userId)
    {
        $user = User::findOrFail($userId);
        // dd($user);
        return view('admin.dashbord.updateforgetPasswrd',compact('user'));
    }
}
