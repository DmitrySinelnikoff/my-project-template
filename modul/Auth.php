<?php
namespace modul;

use models\UsersModel;

trait Auth 
{
    public function rule(): void
    {
        $token = $_COOKIE['remember_token'] ?? null;
        $user = new UsersModel();
        $res = $user->all()->where('remember_token', '=', $token)->get();
        if($res == null){
            header("Location: /auth/login");
        }
    }
}