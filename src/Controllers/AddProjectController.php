<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Entities\Validator;
use App\Models\ProjectsModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AddProjectController extends Controller
{
    protected ProjectsModel $model;

    public function __construct(ProjectsModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, Array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
        if (Validator::validateAddProject($data)) {
            $attempt = $this->model->addProject($data['name'], $data['about'], ($data['githubLink'] ?? null), $data['liveVersion'] ?? null);
            if ($attempt) {
                return $this->respondWithJson($response, ['Project added!']);
            }
            return $this->respondWithJson($response, ['It broke :( Not added'], 400);
        }
        return $this->respondWithJson($response, ['Check your input! Validation failed :( Not added'], 400);
    }
}