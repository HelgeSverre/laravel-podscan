<?php

namespace HelgeSverre\Podscan\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class Category extends Data
{
    public function __construct(

        #[MapName('category_id')]
        public readonly string $id,

        #[MapName('category_name')]
        public readonly string $name,

        #[MapName('category_display_name')]
        public readonly string $displayName,

    ) {
    }
}
