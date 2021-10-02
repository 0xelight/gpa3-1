<?php
if( ! function_exists('css_url'))
{
	function css_url($nom)
	{
		return base_url().'asset/css/'.$nom.'.css';
	}
}
if( ! function_exists('img_url'))
{
	function img_url($nom)
	{
		return base_url().'asset/img/'.$nom;
	}
}
if( ! function_exists('js_url'))
{
	function js_url($nom)
	{
		return base_url().'asset/js/'.$nom.'.js';
	}
}
if ( ! function_exists('classe')){
	function classe()
	{
		$CI=get_instance();
		$log=$CI->session->userdata('login');
		if(isset($log)){
			return $log;
		}else{
			return false;
		}
	}
}
?>