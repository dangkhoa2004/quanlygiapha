<?php

namespace App\Http\Controllers;

use App\Services\RelationshipService;

class RelationshipController extends Controller
{
    protected $relationshipService;

    public function __construct(RelationshipService $relationshipService)
    {
        $this->relationshipService = $relationshipService;
    }

    public function index()
    {
        $relationships = $this->relationshipService->getAllRelationships();
        return view('relationships.index', compact('relationships'));
    }

    public function getRelationshipData()
    {
        $treeData = $this->relationshipService->getRelationshipData();
        return response()->json($treeData);
    }
}
