<?php

function isLogged(): bool
{
    return !empty($_SESSION['user_id']) && !empty($_SESSION['pseudo']);
}

function welcomMessage(): string
{
    return (($_SESSION['role'] = 'admin') ? 'Admin' : '')  . ' ' . $_SESSION['pseudo'];
}
