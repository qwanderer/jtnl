<?php

namespace App\Http\Controllers\UserCab;

use App\Claim;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClaim;

class ClaimController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("user_cab.main_view", [
            'claims'=>auth()->user()->claims()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->cant('create', Claim::class)) {
            return redirect()->route("user.claim.index")->with('flash', "U have max claims, delete one to add another");
        }
        return view("user_cab.claim.create_form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClaim $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClaim $request)
    {
        if (auth()->user()->cant('create', Claim::class)) {
            return redirect()->route("user.claim.index")->with('flash', "U have max claims, delete one to add another");
        }


        $validatedData = $request->validated();
        Claim::create(array_merge($validatedData, ['user_id' => auth()->id()]));

        return redirect()->route("user.claim.index")
            ->with('flash', 'Your claim has been added!');
    } // func

    /**
     * Display the specified resource.
     *
     * @param Claim $claim
     * @return \Illuminate\Http\Response
     */
    public function show(Claim $claim)
    {
        return redirect()->route('user.claim.edit', ['claim'=>$claim]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Claim $claim
     * @return \Illuminate\Http\Response
     */
    public function edit(Claim $claim)
    {
        return view("user_cab.claim.update_form", ['claim'=>$claim]);
    } // func

    /**
     * Update the specified resource in storage.
     *
     * @param Claim $claim
     * @return \Illuminate\Http\Response
     */
    public function update(Claim $claim)
    {

        $this->authorize('update', $claim);

        $claim->update(request()->validate([
            'title'=>"required|min:5|max:255",
            'descr'=>"required|min:5|max:255",
            'rail_id'=>'exists:rails,id',
            'category_id'=>'exists:categories,id'
        ]));

        return redirect()->route('user.claim.edit', ['claim'=>$claim]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Claim $claim
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Claim $claim)
    {
        $this->authorize('delete', $claim);
        $claim->delete();
        return redirect()->route("user.claim.index")->with('flash', "Claim deleted");
    }
}
