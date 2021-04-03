<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;


class HomeController extends Controller
{
    public function index(Project $project, $page = 1, $order_by = "id")
    {
        $valid_order_bys = ['id', 'status', 'description', 'name'];

        $order_by = (in_array($order_by, $valid_order_bys)) ? $order_by : 'id';

        $projects = $project -> orderBy($order_by, 'asc') -> paginate(10, ['*'], 'page', $page);

        return view('pages.list-of-projects', compact('projects', 'order_by'));
    }
    //
}
