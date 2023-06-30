# useCase
Use case for Sprint Technology

# Installation

execute the following command in your directory
```bash
composer require hugol/use-case:dev-main
```

# setup
create an index.php in wich you require `vendor/autoload.php`
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

| name | type |
|---|---|
| `from` | string |
| `to` | string |
| `seat` | string |
| `type` | string |
| `reference` | string |
| `dock` | string |
| `gate` | string |
| `transfer` | boolean |