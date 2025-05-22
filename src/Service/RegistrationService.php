<?php

declare(strict_types=1);

namespace Src\Service;

/* This class will:
    - Talk to the UserModel
    - Decide what to do (register or stop)
    - Use the Validator to check if data is valid
 */

use Src\Model\UserModel;
use Src\Validation\Validator;

class RegistrationService
{
    private UserModel $userModel;
    private Validator $validator;

    public function __construct(UserModel $userModel, Validator $validator)
    {
        $this->userModel = $userModel;
        $this->validator = $validator;
    }

    public function register(array $data): array
    {
        // Validate data
        $errors = $this->validator->validate($data);
        if (!empty($errors)) {
            return ['status' => false, 'errors' => $errors];
        }

        // Check if user exists
        if($this->userModel->findByEmail($data['email'])) {
            return ['status' => false, 'errors' => 'Email already exists'];
        }

        // Register user
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $success = $this->userModel->createUser($data['name'], $data['email'], $hashedPassword);
        return ['status' => $success];

    }
}
