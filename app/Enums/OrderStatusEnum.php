<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case CONFIRMED = 'confirmed';
    case PENDING = 'pending';
    case DECLINED = 'declined';
}
