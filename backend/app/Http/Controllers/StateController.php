<?php

namespace App\Http\Controllers;

// Composer
use App\Model\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $result = State::getStates();
        return response()->json($result);
    }

    public function show($id)
    {
        $state = State::find($id);

        if (!$state) {
            return response()->json([
                'success' => false,
                'message' => 'State not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $state->toArray()
        ], 400);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('term');
        $result = State::getStates($searchTerm);

        return response()->json($result);
    }
}