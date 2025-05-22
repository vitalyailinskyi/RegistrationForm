<?php

namespace Src;

use Exception;
use Src\Controller\UserController;
use Src\Model\UserModel;
use Src\Service\RegistrationService;
use Src\Validation\Validator;
use Src\Database\Connection;
use Src\Config;

class Container {
    private array $instances = [];

    public function get(string $class)
    {
        if (!isset($this->instances[$class])) {
            $this->instances[$class] = $this->create($class);
        }

        return $this->instances[$class];
    }

    private function create(string $class)
    {
        switch ($class) {
            case Config::class:
                $env = parse_ini_file(__DIR__ . '/../.env');
                return new Config($env);

            case Connection::class:
                return new Connection($this->get(Config::class));

            case UserModel::class:
                return new UserModel($this->get(Config::class), $this->get(Connection::class));

            case RegistrationService::class:
                return new RegistrationService($this->get(UserModel::class), $this->get(Validator::class));

            case Validator::class:
                return new Validator();

            case UserController::class:
                return new UserController($this->get(RegistrationService::class));

            default:
                throw new Exception("Unknown class: $class");
        }
    }
};