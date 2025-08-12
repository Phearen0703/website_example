<?php

function getCurrentUser()
{
    $user_id = auth()->user()->id;
    $user = DB::table('users')->find($user_id);
    return $user;
}