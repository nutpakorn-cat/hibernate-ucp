<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Filename: dbhelper_helper.php
// Part of nutterrocker's HibernateUCP.
// Copyright (C) 2014 nutterrocker. Any rights allowed except change product name.
/*
 * ตั้งค่า iConomy Authme
 */
/*
 *  ====================== [ Table ] ====================== 
 */
if ( ! function_exists('table_iconomy'))
{
	function table_iconomy()
	{
            return "iconomy"; //ชื่อตาราง plugins เงิน ค่า Default คือ iconomy
	}
}
if ( ! function_exists('table_authme'))
{
	function table_authme()
	{
            return "authme"; //ชื่อตาราง plugins ล็อกอิน ค่า default คือ authme
	}
}
/*
 * ====================== [ Column ] ====================== 
 */
if ( ! function_exists('col_username'))
{
	function col_username()
	{
            return "username"; //ชื่อคอลัมภ์ username ของทั้ง iconomy และ authme
	}
}
if ( ! function_exists('col_password'))
{
	function col_password()
	{
            return "password"; //ชื่อคอลัมภ์ password ของ authme
	}
}
if ( ! function_exists('col_balance'))
{
	function col_balance()
	{
            return "balance"; //ชื่อคอลัมภ์ balance ของ iconomy 
	}
}