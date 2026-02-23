<?php

namespace App\Enums;

enum HighSchool: string
{
    case BishopMcDevitt = 'BM';
    case CentralDauphinHighSchool = 'CD';
    case BishopCentral_Dauphin_East = 'CDE';
    case DauphinCountyTechnicalSchool = "DCT";
    case HarrisburgChristianSchool = "HC";
    case Other = "OT";




    public function label(): string
    {
        return match ($this) {
            self::BishopMcDevitt => 'Bishop McDevitt High School',
            self::CentralDauphinHighSchool => 'Central Dauphin High School',
            self::BishopCentral_Dauphin_East => 'Central Dauphin East High School',
            self::DauphinCountyTechnicalSchool => 'Dauphin County Technical School',
            self::HarrisburgChristianSchool => 'Harrisburg Christian School',
            self::Other => 'Other',
        };
    }

    public static function asArray(): array
    {
        return array_reduce(self::cases(), function ($carry, $case) {
            $carry[$case->value] = $case->label();
            return $carry;
        }, []);
    }
}
