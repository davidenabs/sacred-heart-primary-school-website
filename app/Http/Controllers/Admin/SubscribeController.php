<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribes = Subscribe::latest()->get();
        return view('admin.pages.users.subscribe.index', compact('subscribes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.users.subscribe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriberRequest $request)
    {
        Subscribe::create($request->all());
        return to_route('admin.subscribes.create')->with('success', 'subscriber created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscribe $subscribe)
    {
        return to_route('admin.subscribes.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscribe $subscribe)
    {
        return view('admin.pages.users.subscribe.create', compact('subscribe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriberRequest $request, Subscribe $subscribe)
    {
        $subscribe->update($request->all());
        return to_route('admin.subscribes.index')->with('success', 'subscriber updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();

        return response()->json();
    }
}
