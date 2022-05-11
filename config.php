<?php

return [
    [
        "name" => "A",
        "SKU" => "A",
        "UnitPrice" => 50,
        "SpecialPrice" => [
            [
                "type" => "combined",
                "number_of_items" => 3,
                "price" => 130
            ]
        ]
    ],
    [
        "name" => "B",
        "SKU" => "B",
        "UnitPrice" => 30,
        "SpecialPrice" => [
            [
                "type" => "combined",
                "number_of_items" => 2,
                "price" => 45
            ]
        ]
    ],
    [
        "name" => "C",
        "SKU" => "C",
        "UnitPrice" => 20,
        "SpecialPrice" => [
            [
                "type" => "combined",
                "number_of_items" => 2,
                "price" => 38
            ],
            [
                "type" => "combined",
                "number_of_items" => 3,
                "price" => 50
            ],
        ]
    ],
    [
        "name" => "D",
        "SKU" => "D",
        "UnitPrice" => 15,
        "SpecialPrice" => [
            [
                "type" => "linked",
                "linked_product" => "A",
                "number_of_items" => 1,
                "price" => 5
            ]
        ]
    ],
    [
        "name" => "E",
        "SKU" => "E",
        "UnitPrice" => 5,
        "SpecialPrice" => []
    ],
];
