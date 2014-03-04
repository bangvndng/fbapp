<?php
/**
 * This model behavior builds a date range search condition.
 */
class EDateRangeSearchBehavior extends CActiveRecordBehavior
{
 
    /**
     * @param the default 'from' date when nothing is entered.
     */
    public $dateFromDefault = '2013-01-01 00:00:00';
 
    /**
     * @param the default 'to' date when nothing is entered.
     */
    public $dateToDefault = '2099-12-31 00:00:00';
 
    /**
     * @param the default input date format
     */
    public $dateInput = '%d/%m/%Y';
 
    /**
     * @param the default db date format
     */
    public $dateDb = '%Y-%m-%d %H:%M:%S';
 
    /**
     * Makes a timestamp from a date and a format
     * @param string $strptimeFormat strftime format
     * @param string $date date to parse
     * @return timestamp
     */
    private function date_create_from_strfimeformat($format, $date) {
        $arrDate = strptime($date, $format);
        if (!$arrDate) return 0;
        $arrDate['tm_year'] += 1900;
        $arrDate['tm_mon']++;
        $ts = mktime($arrDate['tm_hour'], $arrDate['tm_min'], $arrDate['tm_sec'], $arrDate['tm_mon'], $arrDate['tm_mday'], $arrDate['tm_year']);
        return $ts;
    }
 
    /**
     * Transforms an input (IHM) formated date
     * into an output (DB) formated date
     * @param string $in the IHM date
     * @return $string the DB date
     */
    private function formatDate($in) {
        $ts = $this->date_create_from_strfimeformat($this->dateInput, $in);
        if ($this->dateDb!='')
            $out = strftime($this->dateDb, $ts);
        else
            $out = $ts;
        return $out;
    }
 
    /*
     * Date range search criteria
     * public $attribute name of the date attribute
     * public $value value of the date attribute
     * @return instance of CDbCriteria for the model's search() method
     */
    public function dateRangeSearchCriteria($attribute, $value)
    {
        // Create a new db criteria instance
        $criteria = new CDbCriteria;
 
        // Check if attribute value is an array
        if (is_array($value))
        {
            // Check if either key in the array has a value
            if (!empty($value[0]) || !empty($value[1]))
            {
                // Set the date 'from' variable to the first value in the array
                $dateFrom = $value[0];
                if (empty($dateFrom))
                {
                    // Set the 'from' date to the default
                    $dateFrom = $this->dateFromDefault;
                }
                else
                {
                    $dateFrom = $this->formatDate($dateFrom);
                }
                 // Set the date 'to' variable to the second value in the array
                $dateTo = $value[1];
                if (empty($dateTo))
                {
                    // Set the 'to' date to the default
                    $dateTo = $this->dateToDefault;
                }
                else
                {
                    $dateTo = $this->formatDate($dateTo);
                }
                // Check if the 'from' date is greater than the 'to' date
                if ($dateFrom > $dateTo)
                {
                    // Swap the dates around
                    list($dateFrom, $dateTo) = array($dateTo, $dateFrom);
                }
                if (strlen($dateTo)==19)
                {
                    $dateTo = str_replace('00:00:00', '23:59:59', $dateTo);
                }
                elseif ($this->dateDb=='')
                {
                    $dateTo += (23*3600)+(59*60)+59;
                }
                // Add a BETWEEN condition to the search criteria
                $criteria->addBetweenCondition($attribute, $dateFrom, $dateTo);
            }
            else
            {
                // The value array is empty so set it to an empty string
                $value = '';
                // Add a compare condition to the search criteria
                $criteria->compare($attribute, $value, true);
            }
        }
        else
        {
            // Add a standard compare condition to the search criteria
            $criteria->compare($attribute, $value, true);
        }
        // Return the search criteria to merge with the model's search() method
        return $criteria;
    }
}
