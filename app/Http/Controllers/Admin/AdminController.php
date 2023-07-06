<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UjianSesiRuangan;
use App\Models\User;
use App\Models\userPengawas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
    public function password($password)
    {
        return bcrypt($password);
        // return view('admin.dashboard');
    }

    public function createAkunPengawas()
    {
        DB::beginTransaction();

        try {
            //code...
            $sesiRuangan = UjianSesiRuangan::all();
            foreach ($sesiRuangan as $row) {
                $randomText = strtoupper(Str::random(6)); // Membuat password acak dengan 6 karakter
                $user = User::create([
                    "username" => $randomText,
                    "password" => bcrypt($randomText),
                    "user_role_id" => 3,
                ]);
                userPengawas::create([
                    'user_id' => $user->id,
                    'ujian_sesi_ruangan_id' => $row->id,
                ]);
            }
            DB::commit();
            return $sesiRuangan;
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }
    }

    public function index()
    {

        return view('admin.dashboard');
    }
}
