<?php

namespace App\Http\Controllers;

use App\Models\Republier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRepublierRequest;
use App\Http\Requests\UpdateRepublierRequest;
use Illuminate\Http\Request;

class RepublierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
$request->validate([
    'post_id'=> 'required|exists:posts,id',
]);

$user_id=$request->user()->id;

$republier=Republier::where('reposted_by', $user_id)
   ->where('post_id', $request->post_id)
    ->first();
// dd($save)
if($republier){
    $republier->delete();
         return redirect()->route('feed.index')
                ->with('success', 'save removed successfully.');
}

$republier = new republier();
$republier->reposted_by=$user_id;
$republier->post_id=$request->post_id;
$republier->save();
      return redirect()->route('feed.index')
            ->with('success', 'save added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Republier $republier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Republier $republier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepublierRequest $request, Republier $republier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Republier $republier)
    {
        //
    }
}
