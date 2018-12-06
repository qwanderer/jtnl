<?php

namespace App\Http\Controllers\UserCab;

use App\Claim;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClaim;
use Illuminate\Support\Facades\Storage;

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
        //dd([storage_path("claims"),  public_path()]);
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

        $images = $validatedData['imgs'];
        unset($validatedData['imgs']);

        $claim = Claim::create(array_merge($validatedData, ['user_id' => auth()->id()]));

        $claim->saveImages($images);

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
        //dd("edit");
        return view("user_cab.claim.update_form", ['claim'=>$claim]);
    } // func









    public function update(Claim $claim)
    {
        $this->authorize('update', $claim);

        $validatedData = request()->validate(Claim::getValidationRules());

        $images = $validatedData['imgs'];
        unset($validatedData['imgs']);

        $claim->update($validatedData);

        if($images and is_array($images) and count($images)>0)
        {
            $all_images = [];
            foreach($images as $image)
            {
                $name = $image->getClientOriginalName();
                $image->move($claim->getPathToImgs(), $name);
                $all_images[] = $name;
            } // foreach
            $claim->addImages($all_images);
        } // if
        return redirect()->route('user.claim.edit', ['claim'=>$claim]);

    } // FUNC


    /**
     * Remove the specified resource from storage.
     * @param Claim $claim
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Claim $claim)
    {
        $this->authorize('delete', $claim);

        $claim->delete();
        return redirect()->route("user.claim.index")->with('flash', "Claim deleted");
    }
}
