# PHPAlgorithms
<img src="https://www.dogan-ucar.de/wp-content/uploads/2018/09/PHPAlgorithms.png" data-canonical-src="https://www.dogan-ucar.de/wp-content/uploads/2018/09/PHPAlgorithms.png" width="200" height="170" />

A collection of common algorithms implemented in PHP. The collection is based on "Cracking the Coding Interview" by Gayle Laakmann McDowell

The library is in a beta state. Missing something? Create a pull request!

You can find the package on Packagist: https://packagist.org/packages/doganoo/php-algorithms

## Why Using PHPAlgorithms?

"Algorithms + Data Structures = Programs" 

Algorithms are a part of the basic toolkit for solving problems. Data Structures organize data in an efficient way. The combination of both allow the creation of smart and efficient software.

## Installation

You can install the package via composer:

```bash
composer require doganoo/php-algorithms
```

## Usage

Here's an Binary Tree example:

```php
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree;

$binaryTree = new BinaryTree();
$binaryTree->insertValue(50);
$binaryTree->insertValue(25);
$binaryTree->insertValue(75);
$binaryTree->insertValue(10);
$binaryTree->insertValue(100);

echo json_encode($binaryTree);
```

produces
```php
{"nodes":{"value":50,"left":{"value":25,"left":{"value":10,"left":null,"right":null},"right":null},"right":{"value":75,"left":null,"right":{"value":100,"left":null,"right":null}}}}
```

## Contributions

Feel free to send a pull request to add more algorithms and data structures. Please make sure that you read https://github.com/doganoo/PHPAlgorithms/wiki/Best-Practices before opening a PR.
Please also consider https://github.com/doganoo/PHPAlgorithms/blob/master/CONTRIBUTING.md.

## Maintainer/Creator

Doğan Uçar ([@doganoo](https://www.dogan-ucar.de))

## License

MIT