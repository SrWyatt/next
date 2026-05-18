<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('perfil', ['type' => 'users', 'id' => Auth::user()->id]);
        }

        $users = DB::table('users')->get()->map(function($user) {
            $probabilidad = rand(1, 100);
            if ($probabilidad <= 5) {
                $variacion = rand(50, 150) * (rand(0, 1) ? 1 : -1);
            } else {
                $variacion = (rand(-300, 300) / 100);
            }
            $nuevoBalance = max(0, $user->balance + $variacion);
            DB::table('users')->where('id', $user->id)->update(['balance' => $nuevoBalance, 'ultima_var' => $variacion]);
            $user->balance = $nuevoBalance;
            $user->ultima_var = $variacion;
            return $user;
        });

        $admins = Auth::guard('admin')->check() ? DB::table('admins')->get() : collect();
        $support = Auth::guard('admin')->check() ? DB::table('support')->get() : collect();

        $stats = [];
        if (Auth::guard('admin')->check()) {
            $stats = [
                'total_balance' => $users->sum('balance'),
                'avg_balance' => $users->avg('balance'),
                'max_subida' => $users->sortByDesc('ultima_var')->first(),
                'max_caida' => $users->sortBy('ultima_var')->first(),
                'mas_estable' => $users->sortBy(fn($u) => abs($u->ultima_var))->first(),
                'total_accounts' => $users->count() + $admins->count() + $support->count(),
                'ranges' => [
                    'bajo' => $users->where('balance', '<=', 90)->count(),
                    'estable' => $users->where('balance', '>', 90)->where('balance', '<=', 150)->count(),
                    'saludable' => $users->where('balance', '>', 150)->where('balance', '<=', 300)->count(),
                    'sobresaliente' => $users->where('balance', '>', 300)->count(),
                ],
                'top_10' => $users->sortByDesc('balance')->take(10)
            ];
        }

        return view('dashboard', compact('users', 'admins', 'support', 'stats'));
    }

    public function exportCSV()
    {
        $users = DB::table('users')->select('username', 'email', 'balance', 'ultima_var')->get();
        $csvFileName = 'reporte_next_' . date('Ymd_His') . '.csv';
        
        $response = new StreamedResponse(function() use ($users) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Usuario', 'Email', 'Balance', 'Variacion']);
            foreach ($users as $user) {
                fputcsv($handle, [$user->username, $user->email, $user->balance, $user->ultima_var]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $csvFileName . '"');
        return $response;
    }

    public function show($type, $id)
    {
        $user = DB::table($type)->where('id', $id)->first();
        if (!$user) abort(404);
        return view('profile', compact('user', 'type'));
    }

    public function store(Request $request, $type)
    {
        $data = $request->except(['_token']);
        if(isset($data['password'])) $data['password'] = Hash::make($data['password']);
        DB::table($type)->insert($data);
        return back();
    }

    public function update(Request $request, $type, $id)
    {
        if (!in_array($type, ['admins', 'support', 'users'])) return back();
        $data = $request->except(['_token', '_method']);
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        DB::table($type)->where('id', $id)->update($data);
        return back();
    }
}
