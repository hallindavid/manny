![hallindavid](https://circleci.com/gh/hallindavid/manny.svg?style=svg)

# Manny (Short for Manipulators)
a light-weight PHP package of useful common manipulators/formatters.

## Installation with Composer
```sh
composer require hallindavid/manny
```

if using Laravel, the Manny alias should be autodiscovered and usable easily like this.
```php
use Manny;

Manny::phone("8008008000"); // Returns: 800-800-8000
```

for other frameworks, you will likely need to do
```php
require_once "vendor/autoload.php"
use Manny;
Manny::phone("8008008000"); // Returns: 800-800-8000
```

### Manny::phone
Manny::phone - a Canada/US phone formatter - rebuilt better than before from <a target="_blank()" href="https://github.com/hallindavid/phonehelper">hallindavid/phonehelper</a>

**Definition**
```php

/**
* @param string $number
* @param array $options
*
*
* Default Options
*
*    $default_options = [
*        'showCountryCode'         => false,
*        'showAreaCode'            => true,
*        'showExchange'            => true,
*        'showLine'                => true,
*        'showExtension'           => false,
*        'prefix'                  => false,
*        'country_area_delimiter'  => false,
*        'area_exchange_delimiter' => '-',
*        'exchange_line_delimiter' => '-',
*        'line_extension_delimiter'=> ' ext. ',
*    ];
* @return string
*/
function phone($number, $options)
```
**Example**
```php
Manny::phone("8008008000"); 
//outputs 800-800-8000
```
**Extending Manny::phone**

It's pretty easy to extend the phone class - here is an example
```php
class Brack10 extends Manny\Phone
{
    public function __construct($text)
    {
        parent::__construct($text);
        $this->showCountryCode = false;
        $this->showAreaCode = true;
        $this->showExchange = true;
        $this->showLine = true;
        $this->showExtension = false;
        $this->prefix = false;
        $this->country_area_delimiter = '(';
        $this->area_exchange_delimiter = ') ';
        $this->exchange_line_delimiter = '-';
        $this->line_extension_delimiter = ' ext. ';
    }
}

$phone = new Brack10("123456789123456");
$phone->format();
//Returns: (234) 567-8912
```

### Manny::mask
A mask function for formatting fixed-length data.  (great for real-time-masking with <a target="_blank()" href="https://github.com/livewire/livewire">livewire/livewire</a>)

**Definition**
```php
/**
 * @param string $target
 * @param string $pattern
 * @return string
 */
function mask($target, $pattern)
```
**Pattern creation**

`A` should be a placeholder for an alphabetical character<br />
`1` should be a placeholder for a numeric character<br />
all other characters are treated as formatting characters

**Example**
```php
//US Social Security Number
Manny::mask("987654321", "111-11-1111"); //returns "987-65-4321"

//US Zip-code
Manny::mask("The whitehouse zip code is: 20500", "11111"); //returns "20500"

//Canada Postal Code
Manny::mask("K1M1M4", "A1A 1A1"); //

//outputs 987-65-4321
```

### Manny::yoink
use yoink to pull specific key-values from an associative array, and (optionally) pass in defaults.

**Definition**
```php
/**
 * @param array $target - should be key-val associative array
 * @param array $elements - should be flat array with desired key names from target array
 * @param array $defaults (optional) - key-val associative array which will be appended to extracted key-value pairs before returning
 * @return array
 */
function yoink($target, $elements, $defaults = null)
```
**Example**
```php
$array = ['id'  => '17', 'name'=> 'John Doe'];
$elements = ['name', 'role'];
$default_values = ['role'=> 'member'];
Manny::yoink($array, $elements, $default_values);  //Returns: ['name'=>'John Doe','role'=>'member'] ;
```

### Manny::stripper
a preg_replace abstraction easy-to-remember parameters to reduce frequent googling

**Definition**
```php
    /**
     * @param string     $text    - the subject of our stripping
     * @param array|null $options - an array with the return types you'd like
     *      keys can include the following types
     *      alpha - keep the alphabetical characters (case insensitive)
     * 		num - keep the digits (0-9)
     *  	comma - keep commas
     *      colon - keep the : character
     *  	dot - keep periods
     * 		dash - keep dashes/hyphens
     *  	space - keep spaces 
     * 
     * @return string
     */
    function stripper($text, $options = null)
```
**Example**
```php
$string = 'With only 5-10 hours of development, Dave built Manny, saving him atleast 10 seconds per day!';
$config = ['num', 'alpha', 'space'];
Manny::stripper($string,$config); 
//Returns: 'With only 510 hours of development Dave built Manny saving him atleast 10 seconds per day';

$alt_config = ['num'];
Manny::stripper($string,$alt_config); 
//Returns: '51010';
```

### Manny::crumble
a preg_replace abstraction easy-to-remember parameters to reduce frequent googling

**Definition**
```php
    /**
     * @param string $text - the subject of our crumbling
     * @param array $crumbs - an array of positive integers
     * @param bool $appendExtra - keys can include the following types
     * 
     * @return array
     */
    function crumble($string, $crumbs, $appendExtra = false)
    
```
**Example**
```php
Manny::crumble("18008008000888", [1,3,3,4])
//Output: ["1","800","800","8000"];

//with append extra
Manny::crumble("18008008000888", [1,3,3,4],true)
//Output: ["1","800","800","8000", "888"];
```

### Manny::percent
This is a quick-use tool for generating percents.  It cleans up bad data before processing, and has an opinionated workflow (eg. 0/0 = 100%)

**Definition**
```php
    /**
     * @param int|float|string $num - the numerator
     * @param int|float|string $denom - the denominator
     * @param int $precision - keys can include the following types
     * 
     * @return float
     */
    function percent($num, $denom, $precision = 0)
    
```
**Example**
```php
Manny::percent(1,8);
//Output: 12.5;
```

## Testing
There are a tonne of tests for the packaged formats - to run them, pull the package then
```
composer install
composer test
```

## Support
To say thanks, you can share the project on social media or <br />

<a href="https://www.buymeacoffee.com/tDbQ4kg" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" ></a>

## Issues
Please report all issues in the GitHub Issue tracker


## Contributing
Shoot me an email, or DM me on twitter and I am happy to allow other contributors.
