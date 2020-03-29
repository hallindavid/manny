<?php

namespace Manny\PhoneHelper;

use Manny\Phone;

class Raw11 extends Phone
{
    public function __construct($text)
    {
        parent::__construct($text);
        $this->showCountryCode = true;
        $this->showAreaCode = true;
        $this->showExchange = true;
        $this->showLine = true;
        $this->showExtension = false;
        $this->prefix = false;
        $this->country_area_delimiter = false;
        $this->area_exchange_delimiter = false;
        $this->exchange_line_delimiter = false;
        $this->line_extension_delimiter = ' ext. ';
    }
}
