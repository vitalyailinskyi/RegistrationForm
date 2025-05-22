<?php

declare(strict_types=1);

namespace Src\Controller;

// This controller handles the user registration HTTP request.
//use Exception;
use Src\Service\RegistrationService;
use Src\Validation\Validator;
use Src\View;

class UserController
{
    private RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function register(array $data) : void
    {
        $result = $this->registrationService->register($data);

        if(!$result['status']) {
            if(!empty($result['errors'])) {
                $_SESSION['message'] = "Registration failed:\n";
                if(is_array($result['errors'])) {
                    foreach($result['errors'] as $error) {
                        $_SESSION['message'] .= "$error\n";
                        $_SESSION['message_type'] = 'error';
                        header('Location: /');
                        exit;
                    }
                } else {
                    $_SESSION['message'] .= "{$result['errors']}\n";
                    $_SESSION['message_type'] = 'error';
                    header('Location: /');
                    exit;
                }
            } else {
                $_SESSION['message'] = "Registration failed for unknown reasons.\n";
                $_SESSION['message_type'] = 'error';
                header('Location: /');
                exit;
            }
            return;
        }

        $_SESSION['message'] = 'Registration successful!';
        $_SESSION['message_type'] = 'success';
        header('Location: /');
        exit;
    }

    public function showRegistrationForm(): void
    {
        View::render("register_form");
    }
}