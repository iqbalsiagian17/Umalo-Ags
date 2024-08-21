<?php

namespace App\Http\Controllers\Costumer\User;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDetailController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $userDetail = Auth::user()->userDetail;
    
        if (!$userDetail) {
            return redirect()->route('user.create') // Menggunakan nama rute yang benar
                ->with('warning', 'Please complete your details.');
        }
    
        return view('customer.user.show', compact('userDetail','user'));
    }

    public function create()
    {
        return view('customer.user.create'); // Pastikan "Customer" dan "User" menggunakan huruf besar pada "C" dan "U"
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'no_telepone' => 'required|string|max:15',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string|size:5',
            'lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        $userDetail = new UserDetail([
            'user_id' => Auth::id(),
            'no_telepone' => $request->get('no_telepone'),
            'alamat' => $request->get('alamat'),
            'kota' => $request->get('kota'),
            'provinsi' => $request->get('provinsi'),
            'perusahaan' => $request->get('perusahaan'),
            'kode_pos' => $request->get('kode_pos'),
            'lahir' => $request->get('lahir'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
        ]);

        $userDetail->save();

        return redirect()->route('user.show')->with('success', 'Detail has been added');
    }

    public function edit()
    {
        $userDetail = Auth::user()->userDetail;
    
        if (!$userDetail) {
            return redirect()->route('user.create') // Menggunakan nama rute yang benar
                ->with('warning', 'Please complete your details.');
        }
    
        return view('customer.user.edit', compact('userDetail'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_telepone' => 'required|string|max:15',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string|size:5',
            'lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        $userDetail = Auth::user()->userDetail;

        if (!$userDetail) {
            return redirect()->route('user-detail.create')
                ->with('warning', 'Please complete your details.');
        }

        $userDetail->update([
            'no_telepone' => $request->get('no_telepone'),
            'alamat' => $request->get('alamat'),
            'kota' => $request->get('kota'),
            'provinsi' => $request->get('provinsi'),
            'perusahaan' => $request->get('perusahaan'),
            'kode_pos' => $request->get('kode_pos'),
            'lahir' => $request->get('lahir'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
        ]);

        return redirect()->route('user.show')->with('success', 'Detail has been updated');
    }

    public function createPassword(Request $request)
    {
        $user = Auth::user();

        if ($user instanceof \App\Models\User) {
            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            dd('User is not an instance of User model');
        }
        
        return redirect()->route('user.show')->with('success', 'Password has been created successfully.');
    }

public function changePassword(Request $request)
{
    // Validasi input dari pengguna
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();  // Ambil pengguna yang sedang login

    // Cek apakah objek $user adalah instance dari model User
    if ($user instanceof \App\Models\User) {

        // Cek apakah password saat ini cocok dengan yang di database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        // Perbarui password dengan password baru yang di-hash
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('user.show')->with('success', 'Password has been changed successfully.');
    } else {
        dd('User is not an instance of User model');
    }
}

    

}
