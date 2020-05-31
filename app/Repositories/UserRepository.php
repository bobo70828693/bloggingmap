<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function create(array $input)
    {
        try {
            $this->user->name = $input['name'];
            $this->user->token = $input['token'];
            $this->user->password = $input['password'];
            $this->user->email = $input['email'];

            if($this->user->save() != true) {
                throw new \Exception('新增 member 資料表失敗');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $this->user->token;
    }
}
