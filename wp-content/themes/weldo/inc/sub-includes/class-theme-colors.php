<?php

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

if ( ! class_exists( 'Weldo_Color' ) ) {
    class Weldo_Color {
        public $hex;
        public $rgb;
        public $hsl;

        public function __construct ( $hex )
        {
            $hex = str_replace("#", "", $hex);
            $this->hex = $hex;
            $this->rgb = $this->hexToRgb( $this->hex );
            $this->hsl = $this->toHSL( $this->rgb );
        }
        public function back ()
        {
            $this->rgb = $this->HSLtoRGB( $this->hsl );
            $this->hex = $this->rgb2hex(  $this->rgb );
        }
        public function adjust_hue ( $newVal )
        {
            $this->hsl[ 0 ] += $newVal;
            $this->back();
        }
        public function saturate ( $newVal )
        {
            $this->hsl[ 1 ] += $newVal;
            $this->back();
        }
        public function desaturate ( $newVal )
        {
            $this->hsl[ 1 ] -= $newVal;
            $this->back();
        }
        public function lighten ( $newVal )
        {
            $this->hsl[ 2 ] += $newVal;
            $this->back();
        }
        public function darken ( $newVal )
        {
            $this->hsl[ 2 ] -= $newVal;
            $this->back();
        }
        public function get_all ()
        {
            return array
            (
                'hex' => $this->hex,
                'rgb' => $this->rgb,
                'hls' => $this->hsl,
            );
        }
        public function hexToRgb( $hex )
        {
            if( strlen( $hex ) == 3 )
            {
                $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
                $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
                $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
            }
            else
            {
                $r = hexdec( substr( $hex, 0, 2 ) );
                $g = hexdec( substr( $hex, 2, 2 ) );
                $b = hexdec( substr( $hex, 4, 2 ) );
            }
            $rgb = array( $r, $g, $b );
            return $rgb; // returns an array with the rgb values
        }
        public function rgbString()
        {
            return implode( ", ", $this->rgb );
        }
        public function toHSL($rgb) {
            $red = $rgb[0]; $green = $rgb[1]; $blue = $rgb[2];
            $max = max($red, $green, $blue);
            $min = min($red, $green, $blue);

            $lightness = $max + $min;

            if ($max === $min) {
                $saturation = $hue = 0;
            } else {
                $diff = $max - $min;

                if ($lightness < 255) $saturation = $diff / $lightness;
                else $saturation = $diff / (510 - $lightness);

                if ($max === $red) $hue = 60 * ($green - $blue) / $diff;
                elseif ($max === $green) $hue = 60 * ($blue - $red) / $diff + 120;
                elseif ($max === $blue) $hue = 60 * ($red - $green) / $diff + 240;
            }

            return array(fmod($hue, 360), $saturation * 100, $lightness / 5.1);
        }
        public function hueToRGB($p, $q, $decHue) {
            if ($decHue < 0) $decHue += 1;
            else if ($decHue > 1) $decHue -= 1;

            if ($decHue * 6 < 1) return $p + ($q - $p) * $decHue * 6;
            if ($decHue * 2 < 1) return $q;
            if ($decHue * 3 < 2) return $p + ($q - $p) * (2/3 - $decHue) * 6;

            return $p;
        }
        // hue from 0 to 360, saturation and lightness from 0 to 100
        public function HSLtoRGB($hsl) {
            $hue = $hsl[0]; $saturation = $hsl[1]; $lightness = $hsl[2];
            if ($hue < 0) $hue += 360;

            $decHue = $hue / 360;
            $decSaturation = min(100, max(0, $saturation)) / 100;
            $decLightness = min(100, max(0, $lightness)) / 100;

            $q = $decLightness <= 0.5 ? $decLightness * ($decSaturation + 1) : $decLightness + $decSaturation - $decLightness * $decSaturation;
            $p = $decLightness * 2 - $q;

            $red = $this->hueToRGB($p, $q, $decHue + 1/3) * 255;
            $green = $this->hueToRGB($p, $q, $decHue) * 255;
            $blue = $this->hueToRGB($p, $q, $decHue - 1/3) * 255;

            return array( round ( $red ), round ( $green ), round ( $blue ) );
        }
        function rgb2hex($rgb) {
            $hex = '';
            $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
            $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
            $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

            return $hex; // returns the hex value including the number sign (#)
        }
    }
}