<?php

namespace Manny;

class Phone
{
    public $phone;

    public $showCountryCode;
    public $showAreaCode;
    public $showExchange;
    public $showLine;
    public $showExtension;

    public $prefix;
    public $country_area_delimiter;
    public $area_exchange_delimiter;
    public $exchange_line_delimiter;
    public $line_extension_delimiter;

    public $output;

    private $allowed = ['showCountryCode', 'showAreaCode', 'showExchange', 'showLine', 'showExtension',
        'prefix', 'country_area_delimiter', 'area_exchange_delimiter', 'exchange_line_delimiter', 'line_extension_delimiter', ];

    private $defaults = [
        'showCountryCode'         => false,
        'showAreaCode'            => true,
        'showExchange'            => true,
        'showLine'                => true,
        'showExtension'           => false,
        'prefix'                  => false,
        'country_area_delimiter'  => false,
        'area_exchange_delimiter' => '-',
        'exchange_line_delimiter' => '-',
        'line_extension_delimiter'=> ' ext. ',
    ];

    /**
     * @param $text - the phone number we are formatting
     * @param array|null $options - the options for formatting the number
     */
    public function __construct($text, $options = null)
    {
        if (!is_string($text)) {
            throw new \InvalidArgumentException('Phone number is expected to be a string');
        }

        if (is_null($options)) {
            $options = []; //make it an empty array so Yoink can use it still
        } elseif (!is_array($options)) {
            throw new \InvalidArgumentException('Phone number expects options to be NULL or an array');
        }

        $this->phone = $text;

        $newOptions = Manny::yoink($options, $this->allowed, $this->defaults);

        $this->showCountryCode = $newOptions['showCountryCode'];
        $this->showAreaCode = $newOptions['showAreaCode'];
        $this->showExchange = $newOptions['showExchange'];
        $this->showLine = $newOptions['showLine'];
        $this->showExtension = $newOptions['showExtension'];
        $this->prefix = $newOptions['prefix'];
        $this->country_area_delimiter = $newOptions['country_area_delimiter'];
        $this->area_exchange_delimiter = $newOptions['area_exchange_delimiter'];
        $this->exchange_line_delimiter = $newOptions['exchange_line_delimiter'];
        $this->line_extension_delimiter = $newOptions['line_extension_delimiter'];
    }

    /**
     * the main call point to the class -
     * use it like \Manny\Phone::format("987654321", (optional)[$options,...]).
     *
     * @param string     $text    - the phone number we are formatting
     * @param array|null $options - the format settings we'd like to use
     */
    public function format()
    {
        //Clean the string down to it's digits.
        $clean = Manny::stripper($this->phone, ['num']);

        if (strlen($clean) > 0) {
            //Ensure starts with 1
            $clean = (substr($clean, 0, 1) !== '1' ? '1'.$clean : $clean);
        }

        $phone_parts = $this->get_phone_parts($clean);
        $desired_phone_parts = $this->get_desired_phone_parts();
        $delimiters = $this->get_delimiters();

        $parts = [
            'prefix'                  => '',
            'country'                 => '',
            'country_area_delimiter'  => '',
            'area'                    => '',
            'area_exchange_delimiter' => '',
            'exchange'                => '',
            'exchange_line_delimiter' => '',
            'line'                    => '',
            'line_extension_delimiter'=> '',
            'extension'               => '',
        ];

        //Fill in the phone parts
        if (count($desired_phone_parts) > 0) {
            foreach ($desired_phone_parts as $part) {
                if (array_key_exists($part, $parts) && array_key_exists($part, $phone_parts)) {
                    $parts[$part] = $phone_parts[$part];
                }
            }
        }

        //Fill in the delimiter parts
        if (count($delimiters) > 0) {
            foreach ($delimiters as $key=>$val) {
                if ((array_key_exists($key, $delimiters) && array_key_exists($key, $parts))
                        && (($key === 'prefix' && (strlen($parts['country']) > 0)) ||
                                ($key === 'country_area_delimiter' && (strlen($parts['area']) > 0)) ||
                                ($key === 'area_exchange_delimiter' && (strlen($parts['exchange']) > 0)) ||
                                ($key === 'exchange_line_delimiter' && (strlen($parts['line']) > 0)) ||
                                ($key === 'line_extension_delimiter' && (strlen($parts['extension']) > 0)))) {
                    $parts[$key] = $val;
                }
            }
        }

        return trim(implode($parts));
    }

    /**
     * @param string $phone_number
     *
     * @return array
     */
    private function get_phone_parts($phone_number)
    {
        //clean the string down to it's digits
        $crumbled = Manny::crumble($phone_number, [1, 3, 3, 4], true);

        return [
            'country'  => $crumbled[0],
            'area'     => $crumbled[1],
            'exchange' => $crumbled[2],
            'line'     => $crumbled[3],
            'extension'=> $crumbled[4],
        ];
    }

    private function get_desired_phone_parts()
    {
        $desiredPhoneParts = [];
        if ($this->showCountryCode) {
            $desiredPhoneParts[] = 'country';
        }
        if ($this->showAreaCode) {
            $desiredPhoneParts[] = 'area';
        }

        if ($this->showExchange) {
            $desiredPhoneParts[] = 'exchange';
        }

        if ($this->showLine) {
            $desiredPhoneParts[] = 'line';
        }

        if ($this->showExtension) {
            $desiredPhoneParts[] = 'extension';
        }

        return $desiredPhoneParts;
    }

    private function get_delimiters()
    {
        $delimiters = [];

        if ((is_string($this->prefix)) && (strlen($this->prefix) > 0)) {
            $delimiters['prefix'] = $this->prefix;
        }
        if ((is_string($this->country_area_delimiter)) && (strlen($this->country_area_delimiter) > 0)) {
            $delimiters['country_area_delimiter'] = $this->country_area_delimiter;
        }
        if ((is_string($this->area_exchange_delimiter)) && (strlen($this->area_exchange_delimiter) > 0)) {
            $delimiters['area_exchange_delimiter'] = $this->area_exchange_delimiter;
        }
        if ((is_string($this->exchange_line_delimiter)) && (strlen($this->exchange_line_delimiter) > 0)) {
            $delimiters['exchange_line_delimiter'] = $this->exchange_line_delimiter;
        }
        if ((is_string($this->line_extension_delimiter)) && (strlen($this->line_extension_delimiter) > 0)) {
            $delimiters['line_extension_delimiter'] = $this->line_extension_delimiter;
        }

        return $delimiters;
    }
}
