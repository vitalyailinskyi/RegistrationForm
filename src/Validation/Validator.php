<?php

declare(strict_types=1);

namespace Src\Validation;

class Validator
{
    public function validate(array $data): array
    {
        $errors = [];

        // Validate name
        if (empty($data['name'])) {
            $errors[] = "Name is required.";
        } elseif (strlen($data['name']) < 3) {
            $errors[] = "Name must be at least 3 characters.";
        }

        // Validate email
        if (empty($data['email'])) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // Validate password
        if (empty($data['password'])) {
            $errors[] = "Password is required.";
        } elseif (strlen($data['password']) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        return $errors;
    }
}


