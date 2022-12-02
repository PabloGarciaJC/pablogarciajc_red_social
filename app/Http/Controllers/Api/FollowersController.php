<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class FollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Follower::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {

        // $todosFollower = Follower::select('followers.*')
        //     ->where('aprobada', '=', 1)
        //     ->Where('user_id', '=', $request)
        //     ->count();

        // if ($todosFollower > 0) {

        $arrayListados = array();

        $todosFollower = Follower::select('followers.*')
            ->where('aprobada', '=', 1)
            ->Where('user_id', '=', $request)
            ->get();


        foreach ($todosFollower as $registrosFollower) {
            $user = User::find($registrosFollower->seguido);
            array_push($arrayListados, $user);
        }

        return response()->json($arrayListados, 200, []);

        // } else {

        // echo 'no entiendo';
        // $arrayListados = array();

        // $todosFollower = Follower::select('followers.*')
        //     ->where('aprobada', '=', 1)
        //     ->Where('seguido', '=', $request)
        //     ->get();

        // echo $todosFollower;
        // die();

        // foreach ($todosFollower as $registrosFollower) {
        //     $user = User::find($registrosFollower->user_id);
        //     array_push($arrayListados, $user);
        // }

        // return response()->json($arrayListados, 200, []);
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follower $follower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follower $follower)
    {
        //
    }
}
