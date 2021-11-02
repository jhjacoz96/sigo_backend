<?php

namespace App\Utils;

class Objectify
{
	public function object_to_array($d) {
        if (is_object($d))
            $d = get_object_vars($d);

        return is_array($d) ? array_map(__METHOD__, $d) : $d;
    }

    public static function array_to_object($d)
    {
      if (is_array($d)) {
      	if (array_keys($d) !== range(0, count($d) - 1)){
      		return (object) array_map(__METHOD__, $d);
      	} else {
      		return collect($d)->map(function($item){
      			return self::array_to_object($item);
      		});
      	}
      } else return $d;

    }
}
