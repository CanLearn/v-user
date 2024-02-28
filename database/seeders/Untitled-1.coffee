



login ::
http://127.0.0.1:8000/api/auth/login
    ->name && email
    ->password

register
    http://127.0.0.1:8000/api/register
        ->name
        ->phone
        ->email
        ->password

 logout ::
   post :: http://127.0.0.1:8000/api/logout
    headers->baearar auth 
    parameter->id

dashboard manager
    get ::http://127.0.0.1:8000/api/panel/
       index ::get::  http://127.0.0.1:8000/api/panel/users/request('email')
         ->id users
         ->baearar token 
         ->searh :: name , email , created_at
       create :: get::  http://127.0.0.1:8000/api/panel/users/request('email')
         ->id users
         ->auth token 
         ->searh :: name , email , created_at
        