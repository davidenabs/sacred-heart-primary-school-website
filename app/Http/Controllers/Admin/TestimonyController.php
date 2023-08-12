<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function index()
    {
        $testimonies = Testimony::latest()->get();
        return view('admin.pages.testimony.index', ['testimonies' => $testimonies]);
    }

    public function edit(Request $request, Testimony $testimony)
    {
        return view('admin.pages.testimony.edit', compact('testimony'));
    }

    public function update(Request $request, Testimony $testimony)
    {
        $validatedData = $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|string',
            'occupation'=>'nullable|string',
            'review' => 'required|max:500|string',
            'is_approve' => 'required',
        ]);

        $validatedData['is_approve'] = $validatedData['is_approve'] ? true : false;

        $testimony->update($validatedData);
        session()->flash("success", "Testimonial updated successfully");
        return redirect()->route('admin.testimonies.index');

    }

    public function destroy(Testimony $testimony)
    {
        $testimony->delete();

        return response()->json('Deleted successfully');
    }
}
