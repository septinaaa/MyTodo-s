<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Todo::where('user_id', auth()->id())->count();
        $todoCount = Todo::where('user_id', auth()->id())->where('status', 'Todo')->count();
        $inProgressCount = Todo::where('user_id', auth()->id())->where('status', 'In Progress')->count();
        $doneCount = Todo::where('user_id', auth()->id())->where('status', 'Done')->count();

        $todoProgress = $total ? ($todoCount / $total) * 100 : 0;
        $inProgressProgress = $total ? ($inProgressCount / $total) * 100 : 0;
        $doneProgress = $total ? ($doneCount / $total) * 100 : 0;

        return view('dashboard', compact(
            'todoCount', 'inProgressCount', 'doneCount',
            'todoProgress', 'inProgressProgress', 'doneProgress'
        ));
    }
}
