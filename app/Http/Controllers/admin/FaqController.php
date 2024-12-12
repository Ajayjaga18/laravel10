<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQ;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $faqs = FAQ::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', "%{$query}%")
                                ->orWhere('title', 'like', "%{$query}%");
        })->orderBy('id', 'desc')->get();

        return view('admin.faqs.index', [
            'title' => 'faqs Management',
            'faqs' => $faqs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "User Add";
        return view('admin.faqs.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);
        $user = new FAQ;
        $user->title = $validatedData['title'];
        $user->description = $validatedData['description'];
        $user->save();
        return redirect()->route('admin.faqs.index')->with('success', 'Faq created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Faq Edit";
        $faq = FAQ::find($id);
        return view('admin.faqs.edit',compact('title','faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = FAQ::where('id',$id)->first();

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        $user->title = $validatedData['title'];
        $user->description = $validatedData['description'];

        $user->update();
        return redirect()->route('admin.faqs.index')->with('success', 'Faq created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
