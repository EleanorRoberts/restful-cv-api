<?php

namespace App\Factories;

use App\Controllers\GetAllEducationController;
use Psr\Container\ContainerInterface;

class GetAllEducationControllerFactory
{
    public function __invoke(ContainerInterface $container): GetAllEducationController
    {
        $model = $container->get('EducationModel');
        return new GetAllEducationController($model);
    }
}