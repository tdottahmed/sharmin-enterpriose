<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;

class ClientController extends Controller
{
    public function __construct()
    {
        $permissions = [
            'view client' => ['index'],
            'create client' => ['create', 'store'],
            'update client' => ['edit', 'update'],
            'delete client' => ['destroy'],
        ];

        foreach ($permissions as $permission => $actions) {
            $this->middleware("permission:{$permission}", ['only' => $actions]);
        }
    }

    public function index()
    {
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.client.create');
    }

    public function store(ClientRequest $request)
    {
        try {
            $request->handle();
            return redirect()->route('clients.index')->with('success', 'Client created successfully');
        } catch (\Throwable $th) {
            Log::error('Client creation failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function edit(Client $client)
    {
        return view('admin.client.edit', compact('client'));
    }

    public function update(ClientRequest $request, Client $client)
    {
        try {
            $request->handle($client);
            return redirect()->route('clients.index')->with('success', 'Client updated successfully');
        } catch (\Throwable $th) {
            Log::error('Client update failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Client $client)
    {
        try {
            deleteFile($client->image);
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
        } catch (\Throwable $th) {
            Log::error('Client deletion failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
