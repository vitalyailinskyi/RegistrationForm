<?php

namespace Tests\unit;

use PHPUnit\Framework\TestCase;
use Src\Model\UserModel;
use Src\Service\RegistrationService;
use Src\Validation\Validator;

class RegistrationServiceTest extends TestCase
{
    /** @test */
    public function testValidUserData()
    {
        $mockModel = $this->createMock(UserModel::class);
        $mockModel->method('createUser')->willReturn(true);

        $validator = new Validator();

        $service = new RegistrationService($mockModel, $validator);

        $data = [
            'name'=>'Vitalii',
            'email'=>'vitalii@gmail.com',
            'password'=>'strongpassword',
        ];

        $result = $service->register($data);

        $this->assertSame(['status'=> true], $result);
    }
}