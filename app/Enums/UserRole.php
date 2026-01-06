<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case STUDENT = 'student';
    case COMMUNITY_MEMBER = 'community-member';
    case COMMUNITY_CHAIR = 'community-chair';
    case PRESIDENT = 'president';
    case VICE_PRESIDENT = 'vice-president';
}
