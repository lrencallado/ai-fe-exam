<?php

namespace App\Repositories;

use App\Enums\Status;
use App\Mail\NewUserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function createOtherUser(array $data)
    {
        $password = Str::random(12);
        $data['password'] = Hash::make($password);
        $user = $this->create($data);

        $this->notifyNewUserWithDefaultPassword($user, $password);
    }

    protected function notifyNewUserWithDefaultPassword(User $user, string $password)
    {
        Mail::to($user)->send(new NewUserCreated($user, $password));
    }
}
