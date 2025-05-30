<?php

declare(strict_types=1);

namespace Src\Controller;

// This controller handles the user registration HTTP request.
use Src\Service\RegistrationService;
use Src\View;

class UserController
{
    private RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function register(array $data, bool $isJson = false) : void
    {
        $result = $this->registrationService->register($data);

        // If failed with errors
        if(!$result['status']) {
            $errors = $result['errors'] ?? "Registration failed for unknown reasons.";

            if($isJson) {
                http_response_code(422);
                echo json_encode(['error' => is_array($errors) ? implode("\n", $result['errors']) : $errors]);
                return;
            }

            $message = "Registration failed:\n" . (is_array($errors) ? implode("\n", $errors) : $errors);
            $this->redirectWithMessage($message, 'error');
            return;
        }

        // If Success response
        if ($isJson) {
            http_response_code(200);
            echo json_encode(['message' => 'Registration successful!']);
        } else {
            $this->redirectWithMessage('Registration successful!','success');
        }
    }

    public function showRegistrationForm(): void
    {
        View::render("register_form");
    }

    private function redirectWithMessage(string $message, string $messageType): void
    {
        $_SESSION['message'] = $message;
        $_SESSION['message_type'] = $messageType;
        header('Location: /');
        exit;
    }
}