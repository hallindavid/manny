![hallindavid](https://circleci.com/gh/hallindavid/manny.svg?style=svg)

# Manny

a package of maniulators and formatters that hopefully come in useful for those of us who always forget regex when we need it (manny is short for manipulation)

## Getting Started / Installation

```
composer require hallindavid/manny
```

Laravel should autodiscover the Alias.

You should now be able to use the Manny alias

eg:
```
Manny::percent(1,4) //produces 25 by default
```


## Usage

For basic usage, you can use the alias `Manny` and the format function
```

use Manny;

class TestController extends Controller
{
    public function index() {
        $percent = Manny::percent(1,4);
    }
}
```

## Manipulators

Manny comes with these manipulators



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
