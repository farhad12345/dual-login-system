<?php

use App\Models\WahajUser;

if (!function_exists('currentWahajUser')) {
    function currentWahajUser()
    {
        $userId = session('wahajuser_id');
        return $userId ? WahajUser::find($userId) : null;
    }
}
