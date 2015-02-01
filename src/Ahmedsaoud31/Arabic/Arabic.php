<?php 
namespace ahmedsaoud31\Arabic;
 
class Arabic {
	
	public static function cut($text, $len)
	{
		$cutText = '';
		$text = strip_tags($text);
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
	
	public static function test()
	{
		return 'Test';
	}
	
	public static function adate($format, $timestamp = null)
	{
		
		if($timestamp != null)
		{
			if(preg_match('/[^0-9]/',$timestamp))
			{
				$timestamp = strtotime($timestamp);
			}
			else
			{
				$timestamp = (int)$timestamp;
			}
		}
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
			return self::num(str_ireplace($eArr, $aArr, date($format)));
		}
		else
		{
			return self::num(str_ireplace($eArr, $aArr, date($format, $timestamp)));
		}
	}
	
	public static function num($num)
	{
		$eArr = array('0','1','2','3','4','5','6','7','8','9','.');
		$aArr = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩','٫');
		return str_ireplace($eArr, $aArr, $num);
	}
	
	public static function since($time)
	{
		if(preg_match('/[^0-9]/',$time))
		{
			$time = strtotime($time);
		}
		else
		{
			$time = (int)$time;
		}
		$def = time() - $time;
		if($def < 60) return self::sinceScounds($def);
		if($def < (60*60)) return self::sinceMinutes($def);
		if($def < (60*60*24)) return self::sinceHours($def).' و '.self::sinceMinutes($def%(60*60));
		if($def < (60*60*24*7)) return self::sinceDays($def).' و '.self::sinceHours($def%(60*60*24));
		if($def < (60*60*24*30)) return self::sinceWeeks($def).' و '.self::sinceDays($def%(60*60*24*7));
		if($def < (60*60*24*365)) return self::sinceMouths($def).' و '.self::sinceWeeks($def%(60*60*24*30));
		if($def < (60*60*24*365*3)) return self::sinceYears($def).' و '.self::sinceWeeks($def%(60*60*24*365));
		return self::sinceYears($def);
	}
	
	protected static function sinceScounds()
	{
		return 'ثوان';
	}
	
	protected static function sinceMinutes($time)
	{
		$temp = (int)($time/60);
		if($temp < 1) return self::sinceScounds();
		if($temp < 2) return 'دقيقة'; 
		if($temp < 3) return 'دقيقتان'; 
		if($temp < 11) return $temp.' دقائق';
		return $temp.' دقيقة';
	}
	
	protected static function sinceHours($time)
	{
		$temp = (int)($time/(60*60));
		if($temp < 1) return self::sinceMinutes($time);
		if($temp < 2) return 'ساعة'; 
		if($temp < 3) return 'ساعتان'; 
		if($temp < 11) return $temp.' ساعات';
		return $temp.' ساعة';
	}	
	
	protected static function sinceDays($time)
	{
		$temp = (int)($time/(60*60*24));
		if($temp < 1) return self::sinceHours($time);
		if($temp < 2) return 'يوم'; 
		if($temp < 3) return 'يومان'; 
		if($temp < 11) return $temp.' أيام';
		return $temp.' يوم';
	}
	
	protected static function sinceWeeks($time)
	{
		$temp = (int)($time/(60*60*24*7));
		if($temp < 1) return self::sinceDays($time);
		if($temp < 2) return 'أسبوع'; 
		if($temp < 3) return 'أسبوعان'; 
		if($temp < 11) return $temp.' أسابيع';
		return $temp.' أسبوع';
	}
	
	protected static function sinceMouths($time)
	{
		$temp = (int)($time/(60*60*24*30));
		if($temp < 1) return self::sinceWeeks($time);
		if($temp < 2) return 'شهر'; 
		if($temp < 3) return 'شهران'; 
		if($temp < 11) return $temp.' أشهر';
		return $temp.' شهر';
	}
	
	protected static function sinceYears($time)
	{
		$temp = (int)($time/(60*60*24*365));
		if($temp < 1) return self::sinceMouths($time);
		if($temp < 2) return 'سنة'; 
		if($temp < 3) return 'سنتان'; 
		if($temp < 11) return $temp.' سنين';
		return $temp.' سنة';
	}
}
?>