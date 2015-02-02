<?php 
namespace ahmedsaoud31\Arabic;
 
class Arabic {
	
	public static function cut($text, $len)
	{
		$cutText = '';
		$text = strip_tags($text);
		$text = str_replace('&nbsp;',' ',$text);
		if(mb_strlen($text) > $len)
		{
			for($i=$len;$i>0;--$i)
			{
				$temp = mb_substr($text, $i, 1);
				if($temp == " " || $temp == '\s' || $temp == "\n" || $temp == "\t")
				{
					$cutText = mb_substr($text, 0, $i).'...';
					break;
				}
			}
		}
		else
		{
			$cutText = $text;
		}
		return $cutText;
	}
		
	public static function adate($format, $timestamp = null)
	{
		$eArr = array(	'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday',
						'January','February','March','April','May','June','July','August','September','October','November','December',
						'am','pm','AM','PM'
						);
		$aArr = array(	'الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة','السبت',
						'يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر',
						'صباحاً','مساءاً','صباحاً','مساءاً'
						);
		if($timestamp === null)
		{
			return str_ireplace($eArr, $aArr, date($format));
		}
		else
		{
			return str_ireplace($eArr, $aArr, date($format, $timestamp));
		}
	}
	
}
?>