# useCase
Use case for Sprint Technology

# Installation

execute the following command in your directory
```bash
composer require hugol/use-case:dev-main
```

# setup
require `vendor/autoload.php` in your index.php
then use `Hugol\UseCase\BoardingCardManager`

```php
new BoardingCardManager('your-file.extension')
```
Your file need to be at the root of your project
file extension supported: `PHP, JSON`

Exemple of file:
```php
<?php
return [
    ['from' => '', 'to' => '', 'seat' => '', 'type' => ''],
];
```

# data format

| name | type | description |
|---|---| --- |
| `from` | string | start point |
| `to` | string | end point |
| `seat` | string | seat number |
| `type` | string | type of vehicule (bus, train, plane) |
| `reference` | string | reference of the boarding card |
| `dock` | string | *only trains* dock from wich the train leaves |
| `gate` | string | *only plane* gate through which we board the plane |
| `transfer` | boolean | *only plane* are the baggages automaticaly transferred from last travel |