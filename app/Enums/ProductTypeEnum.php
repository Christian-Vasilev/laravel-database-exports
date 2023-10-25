<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum ProductTypeEnum: string
{
    case ALL = 'all';

    case ACCOUNT = 'account';

    case INGAME_GOODS = 'ingame_goods';

    case PHYSICAL_GOODS = 'physical_goods';

    /**
     * Filter cases and return only the ones that can be filtered by
     */
    public static function getFilterableTypesAsArray(string $selectedType): array
    {
        $mappedValues = Arr::map(self::cases(), fn (ProductTypeEnum $status): string => $status->value);
        if ($selectedType === self::ALL->value) {
            return array_filter($mappedValues, fn (string $status): bool => $status !== self::ALL->value);
        }

        return array_filter($mappedValues, fn (string $status): bool => $status === $selectedType);
    }
}
