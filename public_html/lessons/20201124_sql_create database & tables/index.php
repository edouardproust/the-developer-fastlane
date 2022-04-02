<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/create-database-347');

// START EDITING

title('Database'); // '1' or '2' for preset titles

    instruction('Create a new database');

        p('<h4>1. With phpMyAdmin interface</h4>');

            p('<b>Collation:</b> use <code>utf8_general_ci</code> to avoid any compatibility issues. <code>ci</code> means "case-sensitive": upper case and lower case are considered the same.');

        p('<h4>2. With command line</h4>
        <b>Syntax convention:</b> SQL queries are written in upper case and values are in low case. This habit allows to differentiate functions (not changing) and variables (changing).');
        

            codein(); ?>
CREATE DATABASE <i>database_name</i> ;
DEFAULT CHARACTER SET utf8 ;
DEFAULT COLLATE utf8_general_ci<?php codeout();

            p('To get a list of variables for the current database:');

            codein(); ?>
USE <i>database_name</i> ;
SHOW VARIABLES<?php codeout();

    instruction('Delete a database');

        p('<h4>1. With phpMyAdmin interface</h4>
        <ul>
            <li>Click on the database name on le left handside menu</li>
            <li>"Operations" tab</li>
            <li>Section "Remove database": click on "Drop database (DROP)"</li>
        </ul>
        <b>Warning:</b> In MySQL, actions are not reversible. Each action cannot be cancelled once done. This is valid for database and tables deletion (be carefull before delete then).
        ');

        p('<h4>2. With command line</h4>');

        codein(); ?>
DROP DATABASE <i>database_name</i><?php codeout();

title('Table'); // '1' or '2' for preset titles

    instruction('Create a table');

        p('<h4>1. With phpMyAdmin interface</h4>');

            p('Columns:
            <ul>
                <li><b>Name:</b> space is not allowed. So use "-" or "_" characters instead.</li>
                <li><b>Type:</b>
                    <ul>
                        <li>List of options and a detailed explanation for each: <a href="https://www.oreilly.com/library/view/mysql-reference-manual/0596002653/ch06s02.html#:~:text=MySQL%20supports%20a%20number%20of,and%20string%20(character)%20types." target="_blank">click here</a>.</li>
                        <li>While <b>overing with mouse</b> on each selector\'s option, a tooltip displays with explanations on it.</li>
                    </ul>
                </li>
                <li><b>Length:</b> Enter a int value only to allow a maximum lenght (only for text and int values: keep it blank for DATE types). If not usefull: leave blank.</li>
                <li><b>Default:</b> Enter a default value only if the filed is not mandatory.</li>
                <li><b>Collation:</b> If left blank, then the collation defined for database will be applied. In general, <b>leave blank</b> to avoid conflicts and to much complexity.</li>
                <li><b>Attributes:</b>
                    <ul>
                        <li>BINARY: </li>
                        <li>UNSIGNED: No negative integers (no minus sign), but only positive ones. This allows more memory allows for the field for positive values (for example: for TINYINT, the value for UNSIGNED can be from 0 to 255, instead of: from -127 to 128 by default.</li>
                        <li>UNSIGNED ZEROFILL: Same as UNSIGNED but with zeros added until the field length is riched (example: if length filled to 3, the value will be set to "001" for a "1" input.</li>
                        <li>on update CURRENT_TIMESTAMP: usefull for post update fields for example (to show the modification date and time). If using this, then the TYPE must be set to TIMESTAMP.</li>
                    </ul>
                </li>
                <li><b>Null:</b> Check if null values are allowed for this field (very often we leave this unchecked)</li>
                <li><b>Index</b> / <b>A_I</b>: see paragraph below</li>
            </ul>
            <br><b>Storage Engine:</b> We only use 2 options, depending on our needs:
            <ul>
                <li>InnoDB: most often used. A bit slower than MyISAM but allows to recover data if needed.</li>
                <li>MyISAM: faster and allows to do FULLTEXT searches. Downside: may be problematic with some characters</li>
                <li>Complete list of pros and cons for each <a href="https://setra-conseil.com/blog/myisam-vs-innodb/" target="_blank">here</a></li>
            </ul>
            ');
    
            resultin();
                exo_gallery(100, [1, 2]);
            resultout();

        p('<h4>2. SQL Code generation</h4>');

            p('This is used to generate SQL tables code to insert inside PHP script. So the easiest practice is:
            <ol>
                <li>Create a sample table, filling all fields as detailed above (with visual interface)</li>
                <li>Paste the code below inside the command line console of phpMyAdmin</li>
                <li>On next page, click on "+ options" and check "full text" (see image below)</li>
                <li>Copy the generated SQL code and paste it inside the PHP script.</li>
            </ol>');

            codein(); ?>
USE <i>database_name</i> ;
SHOW CREATE TABLE <i>table_name</i><?php codeout();

            resultin();
                exo_gallery(60, [3]);
            resultout();

    instruction('Delete a table');

            codein(); ?>
DROP TABLE <i>database_name</i><?php codeout();

    instruction('Modify a table');

        p('Add a table column:');
            codein(); ?>
ALTER TABLE <i>table_name</i> ;
ADD <i>column_name</i> <i>TYPE</i> (<i>length</i>) <i>ATTRIBUTES</i>
<l>
Example: 
ALTER TABLE users ;
ADD username VARCHAR (255) NOT NULL</l><?php codeout();

        p('Delete a column:');
            codein(); ?>
ALTER TABLE <i>table_name</i> DROP <i>column_name</i><?php codeout();

        p('Change column\'s name:');
            codein(); ?>
ALTER TABLE <i>table_name</i> CHANGE <i>column_name_current</i> <i>column_name_new</i> TYPE NOT NULL

<l>Example:
ALTER TABLE users CHANGE date signup_date DATETIME NOT NULL</l><?php codeout();

        p('Change column\'s type:');
            codein(); ?>
ALTER TABLE <i>table_name</i> MODIFY <i>column_name</i> <i>TYPE_NEW</i> ATTRIBUTES

<l>Example:
ALTER TABLE users MODIFY signup_date TIMESTAMP NOT NULL</l><?php codeout();


title('Keys & Indexes'); // '1' or '2' for preset titles

    instruction('Primary key');

        p('For each new table created, it\'s necessary to define a primary key:
        <ul>
            <li>This is the <b>reference id</b> for each table\'s entry</li>
            <li>Very often, we create a <b>new column called "id"</b> and define it as PRIMARY ("index" column)</li>
            <li>This column allows to target each element as <b>unique</b> (like a post id, a user id, etc...)</li>
            <li><b>A_I (auto_increment)</b>: allows to add +1 to the id for each new table entry. For primary columns, we always check this.</li>
        </ul>
        ');

    instruction('Index');

        p('Other Index types:
        <ul>
            <li>UNIQUE: forbid to have 2 identical values. Example, we can use it for <b>page slugs</b> (having 2 page with the same slug is not possible). While the primary key is in general dedicated to ids, the INDEX option is for other values that need to be unique.</li>
            <li>INDEX: Allows quicker queries (improve performance of database). Downturn: will take more space in the database. So, we\'ll avoid using this option for columns containign hundreds of values. We\'ll keep it only for few values (example: gender (2 values), categories (ten for example), etc.)</li>
            <li>FULLTEXT: Only available for MyISAM storage engine. This will allow to optimize reasearches.</li> 
        </ul>
        ');


// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>