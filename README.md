# Treeize
The ultimate tree library. For all your tree recursion needs.
```php
Treeize::create($tree)->parse()->get();
```

## Installation
You can install this library using [composer](https://getcomposer.org/download/)

`composer require odannyc/treeize`

## Usage
Given a simple array:
```php
$tree = [
  [
    "id" => 1,
    "parent_id" => 0
  ],
  [
    "id" => 2,
    "parent_id" => 1
  ],
  [
    "id" => 3,
    "parent_id" => 1
  ],
  [
    "id" => 4,
    "parent_id" => 2
  ],
  [
    "id" => 5,
    "parent_id" => 2
  ],[
    "id" => 6,
    "parent_id" => 0
  ],
  [
    "id" => 7,
    "parent_id" => 6
  ],
  [
    "id" => 8,
    "parent_id" => 6
  ]
]
```

You will be able to parse this tree and set it correctly recursively doing this:

```php
Treeize::create($tree)->parse()->get();
```
The output will be:

```php
[
  [
    "id" => 1,
    "parent_id" => 0,
    "children" => [
      [
        "id" => 2,
        "parent_id" => 1,
        "children" => [
          [
            "id" => 4,
            "parent_id" => 2
          ],
          [
            "id" => 5,
            "parent_id" => 2
          ]
        ]
      ],
      [
        "id" => 3,
        "parent_id" => 1
      ],
    ]
  ],
  [
    "id" => 6,
    "parent_id" => 0,
    "children" => [
      [
        "id" => 7,
        "parent_id" => 6
      ],
      [
        "id" => 8,
        "parent_id" => 6
      ]
    ]
  ]
]
```

If you'd like to change the "children" key to any other string you can do so by chaining off the `create` method before parsing. So:

```php
Treeize::create($tree)->childrenKey('nodes')->parse()->get();
```

There's other options to chain on that method, here's the whole list:

```php
Treeize::create($tree)
  ->parentKey('pid')
  ->indexKey('id')
  ->parentId(0)
  ->childrenKey('nodes')
  ->parse(function($item) {//do stuff to item})
  ->get();
```

`parentKey`
 - Sets the parent key name: Default is "parent_key"
 
`indexKey`
 - Sets the index key name: Default is "id"
 
`parentId`
 - Sets the initial parent ID to search for: This is figured out if non is provided
 
`childrenKey`
 - Sets the children key name as described above.
 
 `parse`
 - Accepts a callback function that you can apply to each item in the tree, an item is an array in this instance.
