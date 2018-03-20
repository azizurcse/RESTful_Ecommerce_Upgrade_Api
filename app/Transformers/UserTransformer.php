<?php

namespace App\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier'=>(int)$user->id,
            'name'=>(string)$user->name,
            'email'=>(string)$user->email,
            'isVerified'=>(int)$user->verified,
            'isAdmin'=>($user->admin ==='true'),
            'creationDate'=>(string)$user->created_at,
            'lastDate'=>(string)$user->updated_at,
            'deletedDate'=>isset($user->deleted_at) ? (string) $user->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attibutes=[
            'identifier'=>'id',
            'name'=>'name',
            'email'=>'email',
            'isVerified'=>'verified',
            'isAdmin'=>'admin',
            'creationDate'=>'created_at',
            'lastDate'=>'updated_at',
            'deletedDate'=>'deleted_at',
        ];
        return isset($attibutes[$index]) ? $attibutes[$index] : null;
    }
}