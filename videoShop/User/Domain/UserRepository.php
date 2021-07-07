<?php


namespace videoShop\User\Domain;


interface UserRepository
{
    public function register(User $user): bool;
}