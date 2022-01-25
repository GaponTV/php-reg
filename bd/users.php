<?php

function getUsers()
{
    return json_decode(file_get_contents(__DIR__ . '/users.json'), true);
}


function createUser($data){
    $users = getUsers();
    $data['id'] = count($users);
    $users[] = $data;
    putJson($users);
}

function checkUser($login, $password)
{
    $users = getUsers();
    foreach ($users as $user){
        if($user['login'] == $login){
            if($user['password'] == $password){
                return $user;
            }
        }
    }
    return null;
}

function checkLogin($login)
{
    $users = getUsers();
    foreach ($users as $user){
        if($user['login'] == $login){
            return true;

        }
    }
    return false;
}

function checkEmail($email)
{
    $users = getUsers();
    foreach ($users as $user){
        if($user['email'] == $email){
            return true;
        }
    }
    return false;
}
function putJson($users)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}