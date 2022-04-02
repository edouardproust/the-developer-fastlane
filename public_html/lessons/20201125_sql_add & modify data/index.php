<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/insert-into-349');

// START EDITING

title('Easiest and commonly used method');

    instruction("Method to add or modify a table's data");

        p('In general, to insert SQL code into PHP (as part of a query to or from the database), one can use the generator built into phpMyAdmin:
        <ol>
            <li>Select the database in the left menu, then select the table to be modified.</li>
            <li>Click on the "SQL" tab</li>
            <li>Click on the buttons below the textarea: <code>SELECT *</code>, <code>SELECT</code>, <code>INSERT</code>, <code>UPDATE</code> or <code>DELETE</code> depending on your needs.</li>
        </ol>');

    instruction('Syntax rules:');

        p('<ul>
                <li><b>Queries</b> are separated by semicolons ";"</li>
                <li><b>Values</b> are separated by commas ","
                    <ul>
                        <li><b>Strings</b>: always surround by double quotes OR simple quotes (both work fine)</li>
                        <li><b>Numbers</b>: no need of simple nor double quotes</li>
                        <li><b>Floats</b>: use a point before decimals (no comma, unlike we do in france)</li>
                        <li><b><code>DATE</code></b> and <b><code>DATETIME</code></b> : are in US format <code>Y/m/d h:i:s</code>. You can either use "/" or "-" as separators for the date, MySQL will automatically understand that the values are separated.</li>
                    </ul>
                </li></ul>
        ');

    instruction('Conditional operators / selectors');

        p('These are to use after the <code>WHERE</code> statement</b>
        <ul>
            <li>OR, AND,...
                <ul>
                    <li>We use brackets to <b>prioritize conditions</b>.</li>
                    <li>Example: <code>SELECT * FROM users WHERE city = "Paris" AND (firstname = "john OR firstname = "marc");</code></li>
                </ul>
            <li>IN (array): in case of <b>complex conditions</b>, instead of using series of OR, we can use this syntax: <code>SELECT * FROM table_name <b>WHERE column_name IN (value1, value2, value3)</b>;</code>It works for both numbers and strings.</li>
            <li>Equals to, Different from, ...
                <ul>
                    <li>Equals to: with <b>=</b> sign</li>
                    <li>different from: with <<b>!=</b> (or <b><></b>) signs</li>
                    <li>Bigger than / Smaller than: <b>></b>, <b>>=</b> / <b><</b>, <b><=</b></li>
                </ul>
            </li>
            <li><b><code>LIMIT 2, 4</code></b> means "only 4 lines, starting on line 2". Be carefull: First line is ranked 0, so when we write 2 as a strating point, the query will return from the 3rd line of the table (line 2 = 3rd line).</li>
            <li>When we need to <b>select all fields</b> for a query: instead of listing them all, the magic character <b>*</b> will allows to select all. Example: <code>SELECT * FROM users</code> will select all fields of the "users" table. Warning: This has a <b>performance downturn</b>. That\'s why <b>it\'s recommanded to define each field</b> one by one if possible.</li>
        
        </ul>
');

title('If using Command lines');

    p('List of queries:
    <ol>
        <li><b><code>INSERT TO</code></b> : <a href="#insert">key points</a> / <a href="https://www.grafikart.fr/tutoriels/insert-into-349" target="_blank">video</a></li>
        <li><b><code>DELETE FROM</code></b> : <a href="#delete">key points</a> / <a href="https://www.grafikart.fr/tutoriels/delete-from-350" target="_blank">video</a></li>
        <li><b><code>UPDATE</code></b> : <a href="#update">key points</a> / <a href="https://www.grafikart.fr/tutoriels/update-351" target="_blank">video</a></li>
        <li><b><code>SELECT</code></b> : <a href="#select">key points</a> / <a href="https://www.grafikart.fr/tutoriels/select-352" target="_blank">video</a></li>
    </ol>
    ');

    anchor('insert');
    instruction('1. <code>INSERT TO</code>');

        codein(); ?>
INSERT INTO <i>table_name</i> (<i>field1</i>, <i>field2</i>) VALUES   
    ("<i>value1_line1</i>", "<i>value2_line1</i>"),
    ("<i>value1_line2</i>", "<i>value2_line2</i>");
<l>Exemple:
    INSERT INTO users (firstname, surname) VALUES   
        ('Dwayne', 'Johnson'),
        ('Will', 'Smith');</l><?php codeout();

        p('<h4>Key points</h4>
        <ul>
            <li>Columns that are not set with any default value will require one while doing a <code>INSERT TO</code> on them.</li>
        </ul>
        ');

    anchor('delete');
    instruction('2. <code>DELETE FROM</code>');

        p('To delete lines:');
        
        codein(); ?>
DELETE FROM <i>table_name</i> WHERE <i>condition(s)</i> [LIMIT <i>number_of_lines</i>];

<l>Examples:
   
    DELETE FROM users WHERE id = "4";
        // Will delete the user whose id is 4.

    DELETE FROM users WHERE firstname = "Dayne" LIMIT 1;
        // Will delete only the first line in which firstname is set to "Dayne"</l><?php codeout();

        p('To empty a table:');

        codein(); ?>
TRUNCATE TABLE <i>table_name</i>

<l>Example:

    TRUNCATE TABLE users</l><?php codeout();


        p('
        <h4>Key points:</h4>
        <ul>
            <li>Deleted data can\'t be recovered, it\'s definite (no backup system): use <code>LIMIT 1</code> by default at the end of the request (change 1 by the max number of lines to delete)</li>
            <li>For the condition, in general, the id is used as a selection criterion: <code>DELETE FROM users WHERE id="4" LIMIT 1;</code> for example</li>
            <li>A deleted id is NEVER reassigned (auto-increment continues as if no line has been deleted)</li>
            <li>To delete an entire table AND its properties and reset auto-increment, use: <code>TRUNCATE table_name;</code></li>
            <li>Using: <code>DELETE FROM table_name;</code> without passing any <code>WHERE</code> parameter will empty the table, but the properties and auto-increment will not be reset. <code>TRUNCATE</code> allows you to reassign the ids to a new table. 
            <li>It is possible to use <code>OR</code> and <code>AND</code> in the condition. examples:</li>
        </ul>
        ');

        codein(); ?>
DELETE FROM users WHERE id = 1 OR id = 3;
    <l>// Will remove users whose ids are equals to 1 or 3</l>

DELETE FROM users WHERE town = "Paris" AND age < 18 ;
    <l>// Will remove all users under 18 years old living in Paris</l><?php codeout();

    anchor('update');
    instruction('3. <code>UPDATE</code>');

        codein(); ?>
UPDATE <i>table_name</i> SET <i>field1</i>=<i>value1</i> [, <i>field2</i>=<i>value2</i>, ...] WHERE <i>condition(s)</i>;

<l>Examples:

    UPDATE table_name SET town="Paris", gender="h" WHERE id = 4 OR id = 6;
        // Will update "town" and "gender" values for users whose ids are either 4 and 6</l><?php codeout();

        p('
        <h4>Key points:</h4>
        <ul>
            <li>As for <code>DELETE</code>, <code>UPDATE</code> function will by default change all fields. Tha\'s why we set conditions using a <code>WHERE</code> statement.</li>
            <li>You can also use <code>LIMIT 1</code> for example to secure the command and be sure to change only one line.</li>
            <li>You can use the arrhythmia functions (more about that later) after <code>WHERE</code> and <code>SET</code> statements. Example:</li>
        </ul>
        ');

        codein(); ?>
UPDATE users SET surname = firstname ; 
ALTER TABLE users DROP firstname ;
    <l>// Will change the last name to the first name value for all users (then delete the first name column)</l><?php codeout();

    anchor('select');
    instruction('4. <code>SELECT</code>');

    p('<h4>Select data: <code>SELECT</code></h4>');

        codein(); ?>
SELECT <i>field1 [field2, ...]</i> 
    FROM <i>database_name</i> WHERE <i>condition(s)</i> 
    LIMIT <i>number_of_lines</i>

<l>Example:

    SELECT surname, firstname FROM users LIMIT 2, 5;
    
    // Will get values for "surname" and "firstname" fields for lines 2 to 5 in "users" table</ll><?php codeout();

    p('<h4>Reorder data: <code>GROUPE BY</code></h4>');

    codein(); ?>

    SELECT <i>column1 [, column2, ...]</i> 
        FROM <i>table_name</i> 
        [ ORDER BY <i>column1</i> [ASC/DESC] [, column2, ...] ]

<l>Example:
    
    SELECT * 
        FROM users 
        ORDER BY surname DESC, id DESC

    // Will return all users, decreasingly sorted based on the "surname" column (so, form A to Z in this case as the column is set on VARCHAR)
    // And if several lines have the same value for "surname", then these will be decreasingly sorted base on their "id" (so from 0 to 65,536 as id is set to SMALLINT)</l><?php codeout();
    
    p('<h4>Count data: <code>COUNT</code></h4>');

    codein(); ?>
SELECT COUNT(<i>target_column1 [, target_column2, ...]</i>) AS <i>choose_a_name</i> 
    FROM <i>table_name</i>
    
<l>Example:

    SELECT COUNT(id) AS population 
        FROM users
        
    // Will return an integers (example: 4) which corresponds to the total number of lines in the "users" table
    // Output : 'population' => 4</l><?php codeout();

    p('<b><code>COUNT</code> won\'t return NULL values</b> contained in target_column. For example, if we choose to count "surname" column, and if a surname is missing for a line (empty field), then the count will be équal to: total_lines - 1.');

    p('<h4>Group returned data: <code>GROUP BY</code></h4>');

    codein(); ?>
<l>Example:</l>
SELECT COUNT(id) AS pouplation<b>, gender</b>
    FROM users
    GROUP BY <b>gender</b>;
    
<l>// Output: 'female' => 1, 'male' => 3</l><?php codeout();


    p('
    <h4>Some more usefull function to make granular selections</h4>
    <ul>
        <li><b><code>SELECT MAX(column)</code></b> : will return the highest value of the defined range of data</li>
        <li><b><code>SELECT MIN(column)</code></b> : will return the smallest value</li>
        <li><b><code>SELECT AVG(column)</code></b> : will return the average value for the range (only for numeric values)</li>
        <li><b><code>LIKE</code></b> function: allows to make partial research base on specifical <b>string patterns</b>. Very usefull! Example: </li>
    </ul>
    ');

    codein(); ?>
SELECT * FROM users WHERE surname <b>LIKE "J%"</b>;<l>
    // Will return a list of users whose surname starts with "J"</l>

SELECT * FROM users WHERE firstname <b>LIKE "%h%"</b><l>
    // Will return a list of users whose firstname contains the letter "h"</l>
    
SELECT * FROM users WHERE email <b>LIKE "%gmail.com"</b><l>
    // Will return a list of users who are using Gmail as an email service provider</l><?php codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>