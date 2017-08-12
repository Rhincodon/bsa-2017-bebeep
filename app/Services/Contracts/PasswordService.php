<?php

namespace App\Services\Contracts;

use App\Services\Requests\ResetPasswordRequest;
use App\Services\Requests\ForgotPasswordRequest;

interface PasswordService
{
    public function forgot(ForgotPasswordRequest $request);

    public function reset(ResetPasswordRequest $request);
}
