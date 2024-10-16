<?php

/**
 * 揽收信息，默认为关联小包的揽收信息
 * @author auto create
 */
class PickupDto
{
	
	/** 
	 * 揽收地址
	 **/
	public $address;
	
	/** 
	 * 邮箱
	 **/
	public $email;
	
	/** 
	 * 移动电话, 校验格式：^1(3|4|5|6|7|8|9)\d{9}$
	 **/
	public $mobile;
	
	/** 
	 * 揽收联系人名称
	 **/
	public $name;
	
	/** 
	 * 固定电话，可空，校验格式：(^0[\d]{2,3}-[\d]{7,8}$)|(^400[\d]{3,4}[\d]{3,4}$)|(400-[\d]{3,4}-[\d]{3,4}$)
	 **/
	public $phone;	
}
?>