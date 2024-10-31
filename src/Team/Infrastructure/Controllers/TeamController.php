<?php

namespace Src\Team\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomJsonException;
use Src\Team\Infrastructure\Request\StoreTeamRequest;
use Src\Team\Application\UseCases\RegisterTeamUseCase;

class TeamController extends Controller
{
    private $registerTeamUseCase;

    public function __construct(
        RegisterTeamUseCase $registerTeamUseCase
    ) {
        $this->registerTeamUseCase = $registerTeamUseCase;
    }

    /**
     * Store a newly created Team in storage.
     * @param StoreTeamRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws CustomJsonException if there is an error during the Team creation process.
     */
    public function store(StoreTeamRequest $request)
    {
        $storeTeam = $this->registerTeamUseCase->execute($request->all());
        if (!$storeTeam) {
            throw new CustomJsonException(['message' => 'Error creating Team.']);
        }
        return response()->json(['message' => 'Team created successfully.'], 201);
    }

    /**
     * Retrieve and display a listing of all Teams.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return view('teams/index');
    }
}
