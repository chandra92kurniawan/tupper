<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getCode'))
{
	function getCode($lg,$awal)
	{
		$x=$awal+1;
		$ct=strlen($x);
		$gap=$lg-$ct;
		$nl='';
		for($i=0;$i<$gap;$i++){
		$nl .='0';
		}
		return $nl.$x;
	}
}

/* End of file kode_helper.php */