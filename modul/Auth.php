<?php
namespace modul;

use models\UserDataBase;

trait Auth {
    public function rule() {
        $token = $_COOKIE['remember_token'] ?? null;
        $user = new UserDataBase();
        $res = $user->all()->where('remember_token', '=', $token)->get();
        if($res == null){
            header("Location: /auth/login");
        }
    }
}