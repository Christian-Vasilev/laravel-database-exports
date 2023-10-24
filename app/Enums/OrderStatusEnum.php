<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum OrderStatusEnum: string
{
    case ALL = 'all';
    case CONFIRMED = 'confirmed';
    case PENDING = 'pending';
    case DECLINED = 'declined';

    /**
     * Filter cases and return only the ones that can be filtered by
     *
     * @param string $selectedStatus
     *
     * @return array
     */
    public static function getFilterableStatusesAsArray(string $selectedStatus): array
    {
        return array_filter(
            Arr::map(self::cases(), fn (OrderStatusEnum $status): string => $status->value),
            fn (string $status): string => ($selectedStatus === self::ALL->value)
                ? $status !== self::ALL->value
                : $status === $selectedStatus
        );
    }
}
