<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Core\Application\Service\CreateTask\CreateTaskRequest;
use App\Core\Application\Service\CreateTask\CreateTaskService;

class UserController extends Controller
{

    /**
     * @throws Exception
     */
    public function createTask(Request $request, CreateTaskService $service): JsonResponse
    {
        $input = new CreateTaskRequest(
            $request->input('task'),
            $request->input('date_time'),
            $request->input('reminder')
        );
        $response = $service->execute($input);
        return $this->successWithData($response);
    }

}
 