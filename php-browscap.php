<?php

require ("cache.php");

function _sortBrowscap($a,$b)
{
	$sa=strlen($a);
	$sb=strlen($b);
	if ($sa>$sb) return -1;
	elseif ($sa<$sb) return 1;
	else return strcasecmp($a,$b);
}

function _lowerBrowscap($r) {return array_change_key_case($r,CASE_LOWER);}

function get_browser_cached($user_agent)
{//https://alexandre.alapetite.fr/doc-alex/php-local-browscap/
	//Get php_browscap.ini on http://browsers.garykeith.com/downloads.asp

	$cap=null;
	if(!apcu_exists($user_agent))
	{
		$browscapIni=parse_ini_file("./browscap.ini",true,INI_SCANNER_RAW);
		uksort($browscapIni,'_sortBrowscap');
		$browscapIni=array_map('_lowerBrowscap',$browscapIni);

		foreach ($browscapIni as $key=>$value)
		{
			if (($key!='*')&&(!array_key_exists('parent',$value))) continue;
			$keyEreg='^'.str_replace(
				array('\\','.','?','*','^','$','[',']','|','(',')','+','{','}','%'),
				array('\\\\','\\.','.','.*','\\^','\\$','\\[','\\]','\\|','\\(','\\)','\\+','\\{','\\}','\\%'),
				$key).'$';
			if (preg_match('%'.$keyEreg.'%i',$user_agent))
			{
				$cap=array('browser_name_regex'=>strtolower($keyEreg),'browser_name_pattern'=>$key)+$value;
				$maxDeep=8;
				while (array_key_exists('parent',$value)&&array_key_exists($parent=$value['parent'],$browscapIni)&&(--$maxDeep>0))
					$cap+=($value=$browscapIni[$parent]);
				break;
			}
		}
		apcu_add($user_agent,$cap,86400);
	}
	return apcu_fetch($user_agent);
}
?>