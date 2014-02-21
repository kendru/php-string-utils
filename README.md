php-string-utils
================

String utility functions for PHP

## Usage
Since this package is made up strictly of stateless utility functionality,
all methods are made available as static methods of the `\Kendru\Util\Strings`
class. Below are usage examples of each method. Please see unit tests for more
details on the expected outputs from each function.

#### Camel Case
Convert a string with words separated by spaces, underscores, or hyphens to
camelCase.
```php
echo Strings::camelCase('hello, world');
// Prints "helloWorld"
```

#### Title Case
Convert a string to title case, following the guidelines of _The Chicago Manual
of Style_:
- The first and last words of a sentence are always capitalized
- All words within a sentence except for articles, coordinating conjunctions,
and prepositions are capitalized
```php
echo Strings::titleCase('now is the time for all good men');
// Prints "Now Is the Time for All Good Men"
```

#### Increment
This is a more unusual function that generates the next string in an alphabetical
sequence.
```php
echo Strings::increment('car');
// Prints "cas"
```

#### Underscore
Convert a string with words separated by spaces or hyphens or camel-cased
strings to an underscore-separated string.
```php
echo Strings::underscore('dbColumn');
// Prints "db_column"
```

## Testing
Tests can be run using the Composer-managed version of PHPUnit:
```shell
composer install
vendor/bin/phpunit
```
All pull requests must be submitted with passing unit tests.
