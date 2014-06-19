<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function difference_date($start_date, $end_date)
{
	$start_date 	= strtotime($start_date);
	$end_date 		= strtotime($end_date);
	return ($start_date - $end_date)/86400;
}

function difference_hour($start_time, $end_time) {
	$start_time 	= strtotime($start_time);
	$end_time 		= strtotime($end_time);
	return ($end_time - $start_time)/3600;
}

/* End of file MY_date_helper.php */
/* Location: ./application/helpers/MY_date_helper.php */