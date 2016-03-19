<?php
namespace Utils;

/**
 * Utility class for date and time calculation
 *
 * @package Utils
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class DateTime
{
	public static function calculationTime($time)
	{
		$output = '';
		$units = array (
			'day' => '86400',
			'hour' => '3600',
			'minute' => '60',
			'second' =>  '1'
		);

		foreach ($units as $key => $value)
		{
			$count = 0;

			while ($time > ($value-1))
			{
				$time = $time - $value;
				$count++;
			}

			if ($count != 0)
			{
				if (strlen($output) > 0)
					$output .= ', ';

				$output .= $count.' '.$key;

				if ($count > 1)
					$output .= 's';
			}
		}

		return $output;
	}

	public static function printDate($time, $enableHour = true)
	{
		$listMonth = array(
			'01' => 'January',
			'02' => 'February',
			'03' => 'March',
			'04' => 'April',
			'05' => 'May',
			'06' => 'June',
			'07' => 'July',
			'08' => 'August',
			'09' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December'
		);

		$date = date("d ", $time);
		$date .= $listMonth[date("m", $time)].' ';
		$date .= date("Y", $time);

		if ($enableHour)
			$date .= date(" H:i", $time);

		return $date;
	}
}