<?php
/**
 * Theme Functions.
 *
 * @package snapdragon
 */



if ( ! function_exists( 'snapdragon_get_custom_logo' ) ) {
	function snapdragon_get_custom_logo() {
		do_action( 'snapdragon_custom_logo' );
	}
}



if ( ! function_exists( 'snapdragon_main_header' ) ) {
    // Header Navigation content
	function snapdragon_main_header() {
		do_action( 'snapdragon_main_header' );
	}
}



if ( ! function_exists( 'snapdragon_main_footer' ) ) {
    // Footer content
	function snapdragon_main_footer() {
		do_action( 'snapdragon_main_footer' );
	}
}



if ( ! function_exists( 'snapdragon_is_woocommerce_activated' ) ) {
    // Query WooCommerce activation
	function snapdragon_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}



if ( ! function_exists( 'wp_head_meta' ) ) {
	// Adds backwards compatibility for wp_head_meta() introduced with Snapdragon 1.0
	function wp_head_meta() {
		do_action( 'wp_head_meta' );
	}
}



if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Adds backwards compatibility for wp_body_open() introduced with WordPress 5.2
	 *
	 * @since 2.5.4
	 * @see https://developer.wordpress.org/reference/functions/wp_body_open/
	 * @return void
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}



if ( ! function_exists( 'snapdragon_nav_menu_id' ) ) {
	function snapdragon_nav_menu_id( $id ) {
		$locations = get_nav_menu_locations();
        $menu_id = $locations[$id];
        return !empty($menu_id) ? $menu_id : '';
	}
}



if ( ! function_exists( 'snapdragon_child_menu_items' ) ) {
	function snapdragon_child_menu_items(array $menu, $parent_id) {
        $child_menus = [];
        if (!empty($menu) && is_array($menu)) {
            foreach ($menu as $child) {
                if (intval($child->menu_item_parent == $parent_id)) {
                    array_push($child_menus, $child);
                }
            }
        }
        return $child_menus;
    }
}



if ( ! function_exists( 'snapdragon_reload_page' ) ) {
    function snapdragon_reload_page() {
        print('<script type="text/javascript">window.top.location="'.$_SERVER['REQUEST_URI'].'";</script>');
		exit;
    }
}



if ( ! function_exists( 'snapdragon_is_color_light' ) ) {
    function snapdragon_is_color_light($hex) {
        $rgb_values        = snapdragon_rgb_from_hex($hex, true);
        $average_lightness = ($rgb_values['r'] + $rgb_values['g'] + $rgb_values['b']) / 3;
        return $average_lightness >= 127.5;
    }
}



if ( ! function_exists( 'snapdragon_rgb_from_hex' ) ) {   
    function snapdragon_rgb_from_hex($hex, $isSeparated = false) {
        // Format the hex color string.
        $hex = str_replace('#', '', $hex);
    
        if (3 === strlen($hex)) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
        }
    
        // Get decimal values.
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    
        if($isSeparated) {
            return array(
                'r' => $r,
                'g' => $g,
                'b' => $b,
            );
        }
    
        $return = [$r, $g, $b];
        return $return;
    
    }
}



if ( ! function_exists( 'snapdragon_hex_to_hsl' ) ) {
    function snapdragon_hex_to_hsl($RGB, $ladj = 0, $instr = true) {
        if (!is_array($RGB)) {
            $hexstr = ltrim($RGB, '#');
            if (strlen($hexstr) == 3) {
                $hexstr = $hexstr[0] . $hexstr[0] . $hexstr[1] . $hexstr[1] . $hexstr[2] . $hexstr[2];
            }
            $R = hexdec($hexstr[0] . $hexstr[1]);
            $G = hexdec($hexstr[2] . $hexstr[3]);
            $B = hexdec($hexstr[4] . $hexstr[5]);
            $RGB = array($R, $G, $B);
        }
        $r = $RGB[0] / 255;
        $g = $RGB[1] / 255;
        $b = $RGB[2] / 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
    
        $l = ($max + $min) / 2;
    
        $d = $max - $min;
        if ($d == 0) {
            $h = $s = 0;
        } else {
            $s = $d / (1 - abs((2 * $l) - 1));
            switch ($max) {
                case $r:
                    $h = 60 * fmod((($g - $b) / $d), 6);
                    if ($b > $g) {
                        $h += 360;
                    }
                    break;
                case $g:
                    $h = 60 * (($b - $r) / $d + 2);
                    break;
                case $b:
                    $h = 60 * (($r - $g) / $d + 4);
                    break;
            }
        }
        if ($ladj > 0) {
            $l += (1 - $l) * $ladj / 100;
        } elseif ($ladj < 0) {
            $l += $l * $ladj / 100;
        }
        $hsl = array(round($h), round($s * 100), round($l * 100));
    
        if ($instr) {
            return 'hsl(' . $hsl[0] . ',' . $hsl[1] . '%,' . $hsl[2] . '%)';
        }
    
        return $hsl;
    }
}



if ( ! function_exists( 'snapdragon_hsl_to_hex' ) ) {
    function snapdragon_hsl_to_hex($h, $s, $l, $prependPound = true) {
    
        $rgb = snapdragon_hsl_to_rgb($h, $s, $l);
    
        $hexR = $rgb['r'];
        $hexG = $rgb['g'];
        $hexB = $rgb['b'];
    
        $hexR = round($hexR);
        $hexG = round($hexG);
        $hexB = round($hexB);
    
        $hexR = dechex($hexR);
        $hexG = dechex($hexG);
        $hexB = dechex($hexB);
    
        if (strlen($hexR) != 2) {
            if (strlen($hexR) == 1) {
                $hexR = "0" . $hexR;
            } else {
                return false;
            }
        }
        if (strlen($hexG) != 2) {
            if (strlen($hexG) == 1) {
                $hexG = "0" . $hexG;
            } else {
                return false;
            }
        }
        if (strlen($hexB) != 2) {
            if (strlen($hexB) == 1) {
                $hexB = "0" . $hexB;
            } else {
                return false;
            }
        }
    
        //if prependPound is set, will prepend a
        //# sign to the beginning of the hex code.
        //(default = true)
        $hex = "";
        if ($prependPound) {
            $hex = "#";
        }
    
        $hex = $hex . $hexR . $hexG . $hexB;
    
        return $hex;
    }
}



if ( ! function_exists( 'snapdragon_hsl_to_rgb' ) ) {
    function snapdragon_hsl_to_rgb($h, $s, $l) {
        $h /= 360;
    
        $s /= 100;
        $l /= 100;
    
        if ($s == 0) {
            $r = $l * 255;
            $g = $l * 255;
            $b = $l * 255;
        } else {
            if ($l < 0.5) {
                $temp2 = $l * (1 + $s);
            } else {
                $temp2 = ($l + $s) - ($s * $l);
            }
            $temp1 = 2 * $l - $temp2;
    
            $r = 255 * snapdragon_hue_to_rgb($temp1, $temp2, $h + (1 / 3));
            $g = 255 * snapdragon_hue_to_rgb($temp1, $temp2, $h);
            $b = 255 * snapdragon_hue_to_rgb($temp1, $temp2, $h - (1 / 3));
        }
        $rgb['r'] = $r;
        $rgb['g'] = $g;
        $rgb['b'] = $b;
        return $rgb;
    }
}



if ( ! function_exists( 'snapdragon_hue_to_rgb' ) ) {
    function snapdragon_hue_to_rgb($temp1, $temp2, $hue){
        if ($hue < 0) {
            $hue += 1;
        }
        if ($hue > 1) {
            $hue -= 1;
        }
    
        if ((6 * $hue) < 1) {
            return ($temp1 + ($temp2 - $temp1) * 6 * $hue);
        } elseif ((2 * $hue) < 1) {
            return $temp2;
        } elseif ((3 * $hue) < 2) {
            return ($temp1 + ($temp2 - $temp1) * ((2 / 3) - $hue) * 6);
        }
        return $temp1;
    }
}