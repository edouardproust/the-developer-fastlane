<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/numeric-functions-mysql-353');

// START EDITING

title('List of the most frequently used SQL functions');

    p('<ul>
        <li><b>Syntax:</b> Functions are written like the following FUNCTION(parameters). Parameters are precised between brackets. These parameters are changing depending on the function used.
        <li>For more information on a particular function: <b>click on the function\'s name</b> to access to SQL detailed documentation page</li>
        <li>Browse the <b>complete list of SQL functions and operators</b> from the official MySQL documentation <a href="https://dev.mysql.com/doc/refman/8.0/en/sql-function-reference.html" target="_blank">here</a>.</li>
    </ul>');

    instruction('Summury');

        p('<ol>
            <li><b>Numeric functions:</b> <a href="#numeric"> list</a> / <a href="https://www.grafikart.fr/tutoriels/numeric-functions-mysql-353" target="_blank">video</a></li>
            <li><b>Text functions:</b> <a href="#text">list</a> / <a href="https://www.grafikart.fr/tutoriels/function-text-354" target="_blank">video</a></li>
            <li><b>Time functions:</b> <a href="#time">list</a> / <a href="https://www.grafikart.fr/tutoriels/fonctions-dates-355" target="_blank">video</a></li>
        </ol>');

    anchor('numeric');
    instruction('1. Numeric functions');

        p('
        <a href="https://dev.mysql.com/doc/refman/8.0/en/operator-precedence.html">Additions / subtractions, etc.</a> on a field: SELECT *, id + 2 -> Will return a new column called "id = 2" : id = 1 => id + 2 = 3, etc...
        <ul>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/aggregate-functions.html#function_sum">SUM()</a>: Return a sum of all or part of values of a column</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/aggregate-functions.html#function_avg">AVG()</a>: Returns the average value of a column</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/mathematical-functions.html#function_truncate">TRUNCATE()</a>: defines the number of digits after the decimal point for decimal numbers.</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/mathematical-functions.html#function_abs">ABS()</a>: converts to absolute value</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/mathematical-functions.html#function_mod">MOD()</a>: Function "modulo" (recovers the residue of a division between two noombres). In general, we will use the % sign (example: 6 % 4 -> Will return "2").</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/mathematical-functions.html#function_ceil">CEIL()</a>: Rounded up to the next whole number.</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/mathematical-functions.html#function_floor">FLOOR()</a>: Rounded down to the nearest whole number.</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/mathematical-functions.html#function_sqrt">SQRT()</a>: Calculates the square root</li>
        </ul>');

    anchor('text');
    instruction('2. Text functions');

    p('
    <h4>After WHERE statement (conditions):</h4>
        <ul>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-comparison-functions.html#operator_like">LIKE()</a>: Make advanced selections based on particular patterns</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-comparison-functions.html#operator_not-like">NOT_LIKE()</a>: Search for values that don\'t match a particular pattern (opposite of LIKE)</li>
        </ul>
    <h4>After SELECT statement (selections):</h4>
        <ul>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_concat">CONCAT()</a>: Concatenation</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_trim">TRIM()</a>: Allows you to clean up unnecessary character strings. By default, remove spaces before and after a character string. Advanced options: truncate specific characters before and/or after a string.</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_length">LENGTH()</a>: Get the length of a string of characters.</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_lower">LOWER()</a>: Convert to lowercase</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_upper">UPPER()</a>: Convert to uppercase</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_substr">SUBSTR()</a>: Select a part of the string</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_replace">REPLACE()</a>: Replace a string by another one (case sensitive) - Useful to update urls on the whole site for example</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_soundex">SOUNDEX()</a>: Returns the sound of a string (allows to select the values having the same sound when pronounced orally) - Rare use</li>
            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/string-functions.html#function_reverse">REVERSE()</a>: Invert the string of character</li>
        </ul>
    ');

    anchor('time');
    instruction('3. Time functions');

        p('
        <h4>Add and substract time intervals:</h4>
            <ul>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_adddate">ADDDATE()</a>: add a time interval to a date. Available INTERVAL values: YEAR, DAY, MONTH. By default, if no interval is specified but just an integer, the function adds a number of days.</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_subdate">SUBDATE()</a>: subtract an interval from a date.</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_addtime">ADDTIME()</a>: As ADDDATE but for TIME field types (add hours, minutes or seconds)</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_subtime">SUBTIME()</a>: Subtract hours, minutes or seconds from the values contained in a TIME column.</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_datediff">DATEDIFF()</a>: Returns the interval between two dates). By default, returns the number of days. To obtain a DATE, use DATEDIFF inside the FROM_DAYS function (see below).</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_from-days">FROM_DAYS()</a>: Allows to return a date from an interval of days. Format: YYYYY-MM-DD (see sample code at the bottom of this page)</li>
            </ul>
        <h4>Dynamic values:</h4>
            <ul>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_now">NOW()</a>: Default ( noted as: NOW() ), this function retrieves a TIMESTAMP (noted in this format: YYYYY-MM-DD HH:ii:ss). Retrieves the date AND the time.</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_curdate">CURDATE()</a>: retrieves only the date (not the time). Format: YYYYY-MM-DD (year-month-day).</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_curtime">CURTIME()</a>: Retrieves only the time. Format: HH:ii:ss</li>
            </ul>
        <h4>Return part of a date / time:</h4>
            <ul>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_date">DATE()</a>: Extract the date part of a DATE or DATETIME expression</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_time">TIME()</a>: Extract the time portion of the expression passed</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_year">YEAR()</a>: Will return only the date from a TIMESTAMP (format: 0000-00-00 00:00:00:00) or a DATE (format: 0000-00-00-00).</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_month">MONTH()</a> / <a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_week">WEEK()</a> / <a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_day">DAY()</a>: Like YEAR but returns the month of the year / week of the year / day of the month</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_hour">HOUR()</a> / <a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_minute">MINUTE()</a> / <a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_second">SECOND()</a>: Returns the hour / minutes / seconds</li>
            </ul>
        <h4>Date formatting (to be managed at PHP level in general):</h4>
            <ul>
	            <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_date-format">DATE_FORMAT()</a>: For the list of abbreviations, click <a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_date-format">here</a>. See an example at the bottom of the page. The names of the days and months are returned in English.</li>
                <li><a href="https://dev.mysql.com/doc/refman/8.0/en/date-and-time-functions.html#function_get-format">GET_FORMAT()</a>: allows you to retrieve date formats in automatic / prefabricated ways (we won\'t use them because the formats are not necessarily logical and are rigid).</li>
            </ul>
        ');

        codein(null); ?>
Examples:

ADDDATE(birtday, <b>INTERVAL 1 YEAR</b>) 
	<l>// Will return a new column in which values will be equled to the "birthday" column value + 1 year</l>

SELECT * FROM users WHERE <b>birthday < SUBDATE(NOW(), INTERVAL 16 YEAR)</b>;
	<l>// Will select users who are 16 years old at least</l>

SELECT *, DATEDIFF(CURDATE(), birtday) FROM users;
	<l>// Returns a new column containing the interval of days between the current date and the "birtday" column value for each line. -> Output: "857" (for: 857 days)</l>

SELECT *, FROM_DAYS(DATEDIFF(CURDATE(), birtday)) FROM users;
	<l>// Output: "0002-04-07" (for: 2 years, 4 months and 7 days. Which is equivalent to 857 days)</l>

SELECT *, DATE_FORMAT(birthday, "%W %d %M %Y") FROM users;
	<l>// Return a new columns containing "birthday" column values with this new format: "Saturday 27 Octiber 2020".</l>

SELECT COUNT(*) AS population,
	YEAR(birthday) AS year,
	MONTH(birthday) AS month
FROM users
GROUP BY 
	YEAR(birthday),
	MONTH(birthday)

	<l>// Will return a table as following:
	population	year	month
	4		1980	3
	1		1981	5
	2		1982	1</l>
<?php  codeout();


// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>