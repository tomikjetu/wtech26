<?php

namespace App\Helpers;

/**
 * Temporary mock data — replace method bodies with Eloquent queries when DB is ready.
 * Data shapes match what Blade templates expect, so swapping is a one-liner per method.
 */
class MockData
{
    public static function categories(): array
    {
        return [
            ['id' => 1, 'slug' => 'tricka',   'name' => 'Tričká',   'count' => 14],
            ['id' => 2, 'slug' => 'mikiny',   'name' => 'Mikiny',   'count' => 8],
            ['id' => 3, 'slug' => 'muzi',     'name' => 'Muži',     'count' => 12],
            ['id' => 4, 'slug' => 'zeny',     'name' => 'Ženy',     'count' => 10],
            ['id' => 5, 'slug' => 'vypredaj', 'name' => 'Výpredaj', 'count' => 6],
        ];
    }

    public static function sizes(): array
    {
        return ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
    }

    public static function colors(): array
    {
        return [
            ['value' => 'biela',   'label' => 'Biela'],
            ['value' => 'cierna',  'label' => 'Čierna'],
            ['value' => 'sivy',    'label' => 'Šedá'],
            ['value' => 'cervena', 'label' => 'Červená'],
        ];
    }

    public static function products(): array
    {
        return [
            [
                'id'             => 1,
                'name'           => 'TrickoHouse Core',
                'price'          => 24.99,
                'original_price' => null,
                'sale_percent'   => null,
                'img_class'      => 'product-card__img--shirt-white',
                'category_slug'  => 'tricka',
                'category_name'  => 'Tričká',
                'subtitle'       => 'Klasika, ktorú každý potrebuje.',
                'description'    => 'Naše základné tričko z prémiovej bavlny. Pohodlné, odolné a štýlové pre každodenné nosenie.',
                'sizes'          => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
                'colors'         => ['biela'],
                'featured'       => true,
            ],
            [
                'id'             => 2,
                'name'           => 'TrickoHouse Hoodie',
                'price'          => 50.99,
                'original_price' => 59.99,
                'sale_percent'   => 15,
                'img_class'      => 'product-card__img--hoodie-black',
                'category_slug'  => 'mikiny',
                'category_name'  => 'Mikiny',
                'subtitle'       => 'Každý musí mať hoodie.',
                'description'    => 'Naša najpopulárnejšia mikina s kapucňou. Vyrobená z kvalitnej bavlny s pekným dizajnom trickohouse.',
                'sizes'          => ['S', 'M', 'L', 'XL'],
                'colors'         => ['cierna'],
                'featured'       => true,
            ],
            [
                'id'             => 3,
                'name'           => 'TrickoHouse Sport',
                'price'          => 29.99,
                'original_price' => null,
                'sale_percent'   => null,
                'img_class'      => 'product-card__img--shirt-white',
                'category_slug'  => 'tricka',
                'category_name'  => 'Tričká',
                'subtitle'       => 'Pre aktívnych ľudí.',
                'description'    => 'Športové tričko s rýchloschnúcim materiálom. Ideálne na tréning aj voľný čas.',
                'sizes'          => ['XS', 'S', 'M', 'L', 'XL'],
                'colors'         => ['biela', 'cierna'],
                'featured'       => false,
            ],
            [
                'id'             => 4,
                'name'           => 'TrickoHouse Biele',
                'price'          => 19.99,
                'original_price' => 24.99,
                'sale_percent'   => 20,
                'img_class'      => 'product-card__img--tote',
                'category_slug'  => 'vypredaj',
                'category_name'  => 'Výpredaj',
                'subtitle'       => 'Limitovaná akcia.',
                'description'    => 'Špeciálna edícia vo výpredaji. Kvalitný materiál za skvelú cenu.',
                'sizes'          => ['S', 'M', 'L'],
                'colors'         => ['biela'],
                'featured'       => false,
            ],
            [
                'id'             => 5,
                'name'           => 'TrickoHouse Essential',
                'price'          => 22.99,
                'original_price' => null,
                'sale_percent'   => null,
                'img_class'      => 'product-card__img--shirt-white',
                'category_slug'  => 'tricka',
                'category_name'  => 'Tričká',
                'subtitle'       => 'Základ každého šatníka.',
                'description'    => 'Minimalistický dizajn s maximálnym pohodlím. Dostupné v bielej aj čiernej farbe.',
                'sizes'          => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
                'colors'         => ['biela', 'cierna'],
                'featured'       => true,
            ],
            [
                'id'             => 6,
                'name'           => 'Zip Hoodie',
                'price'          => 64.99,
                'original_price' => null,
                'sale_percent'   => null,
                'img_class'      => 'product-card__img--hoodie-black',
                'category_slug'  => 'mikiny',
                'category_name'  => 'Mikiny',
                'subtitle'       => 'Mikina so zipsom pre väčšiu slobodu.',
                'description'    => 'Pohodlná mikina so zipsom po celej dĺžke. Dva vrecká, nastaviteľná kapucňa.',
                'sizes'          => ['S', 'M', 'L', 'XL', 'XXL'],
                'colors'         => ['cierna'],
                'featured'       => false,
            ],
            [
                'id'             => 7,
                'name'           => 'TrickoHouse Classic Muži',
                'price'          => 26.99,
                'original_price' => null,
                'sale_percent'   => null,
                'img_class'      => 'product-card__img--shirt-white',
                'category_slug'  => 'muzi',
                'category_name'  => 'Muži',
                'subtitle'       => 'Pánsky strih pre každého.',
                'description'    => 'Klasické pánske tričko s voľnejším strihom. Pohodlné na celý deň.',
                'sizes'          => ['M', 'L', 'XL', 'XXL'],
                'colors'         => ['biela', 'sivy'],
                'featured'       => false,
            ],
            [
                'id'             => 8,
                'name'           => 'TrickoHouse Dámske',
                'price'          => 21.99,
                'original_price' => 27.99,
                'sale_percent'   => 21,
                'img_class'      => 'product-card__img--shirt-white',
                'category_slug'  => 'zeny',
                'category_name'  => 'Ženy',
                'subtitle'       => 'Dámska edícia s jemným strihom.',
                'description'    => 'Tričko špeciálne navrhnuté pre ženy. Príjemný materiál, moderný strih.',
                'sizes'          => ['XS', 'S', 'M', 'L'],
                'colors'         => ['biela', 'cervena'],
                'featured'       => true,
            ],
        ];
    }

    /**
     * Filter products array by given criteria.
     * Each key maps to a future Eloquent scope of the same name.
     *
     * @param  array  $products  Full product list (replace with DB query result later)
     * @param  array  $filters   Associative array of filter criteria
     */
    public static function filterProducts(array $products, array $filters): array
    {
        return array_values(array_filter($products, function ($p) use ($filters) {
            if (!empty($filters['category']) && $p['category_slug'] !== $filters['category']) {
                return false;
            }
            if (!empty($filters['sizes']) && empty(array_intersect($p['sizes'], (array) $filters['sizes']))) {
                return false;
            }
            if (!empty($filters['colors']) && empty(array_intersect($p['colors'], (array) $filters['colors']))) {
                return false;
            }
            if (isset($filters['price_min']) && $filters['price_min'] !== '' && $p['price'] < (float) $filters['price_min']) {
                return false;
            }
            if (isset($filters['price_max']) && $filters['price_max'] !== '' && $p['price'] > (float) $filters['price_max']) {
                return false;
            }
            if (!empty($filters['search'])) {
                $q = mb_strtolower($filters['search']);
                if (mb_strpos(mb_strtolower($p['name']), $q) === false
                    && mb_strpos(mb_strtolower($p['category_name']), $q) === false) {
                    return false;
                }
            }
            if (!empty($filters['featured']) && ! $p['featured']) {
                return false;
            }

            return true;
        }));
    }
}
