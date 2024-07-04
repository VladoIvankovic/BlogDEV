<?php

class ColorConverter {
    public static function hexToRgb($hex) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        return array($r, $g, $b);
    }

    public static function darkenHex($hex, $percent) {
        $rgb = self::hexToRgb($hex);
        $r = max(0, min(255, $rgb[0] - ($rgb[0] * $percent / 100)));
        $g = max(0, min(255, $rgb[1] - ($rgb[1] * $percent / 100)));
        $b = max(0, min(255, $rgb[2] - ($rgb[2] * $percent / 100)));

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    public static function lightenHex($hex, $percent) {
        $rgb = self::hexToRgb($hex);
        $r = max(0, min(255, $rgb[0] + ($rgb[0] * $percent / 100)));
        $g = max(0, min(255, $rgb[1] + ($rgb[1] * $percent / 100)));
        $b = max(0, min(255, $rgb[2] + ($rgb[2] * $percent / 100)));

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }
}

$hex = "#FF5733";
$rgb = ColorConverter::hexToRgb($hex);
$darkHex = ColorConverter::darkenHex($hex, 20);
$lightHex = ColorConverter::lightenHex($hex, 20);

echo "Original Hex: $hex\n";
echo "RGB: " . implode(", ", $rgb) . "\n";
echo "Darker Hex: $darkHex\n";
echo "Lighter Hex: $lightHex\n";



?>
