<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum ProductTypeEnum: string
{
    case ALL = 'all';

    case CONFIRMED = 'account';

    case PENDING = 'ingame_goods';

    case DECLINED = 'physical_goods';

    /**
     * Filter cases and return only the ones that can be filtered by
     *
     * @param string $selectedType
     *
     * @return array
     */
    public static function getFilterableTypesAsArray(string $selectedType): array
    {
        return array_filter(
            Arr::map(self::cases(), fn (ProductTypeEnum $status): string => $status->value),
            fn (string $status): string => ($selectedType === self::ALL->value)
                ? $status !== self::ALL->value
                : $status === $selectedType
        );
    }
}
