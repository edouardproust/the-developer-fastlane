<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/pdo-php-1141');

// START EDITING

p('<h4>Summury</h4>
<ul> 
    <li><b><a href="#exercise">Exercise</a>: Get data from database</b></li>
    <li><b><a href="#lesson">Lesson</a></b>
        <ol>
            <li><a href="#1">Connext to an SQL database with PHP</a> (new <code>PDO</code> object)</li>
            <li><a href="#2">Create an SQL query</a> (<code>PDO</code> methods, return <code>PDOStatement</code> object)</li>
            <li><a href="#3">Get and send data</a> (<code>PDOStatement</code> methods)
                <ul>
                    <li>Methods</a> (list of the most frequently used)</li>
                    <li>fetch_style method parameters</a> (list of the most frequently used)</li>
                </ul>
            </li>
            <li><a href="#4">Exceptions management</a> (<code>PDO::setAttribute</code>)</li>
            <li><a href="#5">Security notice</a>
                <ul>
                    <li><code>htmlentities()</code></li>
                    <li><code>PDO::quote</code></li>
                    <li><code>PDO::prepare</code> + <code>PDOStatement::execute</code></li>
                </ul>
            </li>
            <li><a href="#6">Several queries at once & Roll back</a> (transactions)</li>
            <li><a href="#7">A few more usefull methods</a></li>
        </ol>
    </li>
</ul>
');

anchor('exercise');
title('Exercise: Get data from database');

    instruction('Database creation');

        p('Made with with DBbrowser (SQLite)'
        ,0,1);

        exo_gallery(100,[1]);

    instruction('Code (OOP)');

        codein(null); ?>&lt;?php

<l>// Logical part</l>

    <b>try</b> {
        $error = null;
        $dsn = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'data.db';
        $pdo = <b>new PDO</b>(
            "sqlite:$dsn", null, null, [ 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, <l>// To be able to catch method-level exceptions</l>
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ <l>// To get an object from the fetch operation (instead of the default array)</l>
        ]);
        <b>try</b> {
            $query = <b>$pdo->query</b>('SELECT * FROM posts ORDER BY date_creation DESC');
            $posts_obj = <b>$query->fetchAll()</b>; <l>// Various fetch operations can be applied here: check lesson to get a list</l>
        } <b>catch</b> (Exception $e) { <l>// Catch exceptions thrown from the method ("query") level</l>
            $error = '&lt;b>Error message:&lt;/b> ' . $e->getMessage();
        }
    } <b>catch</b> (PDOException $e) { <l>// Catch exceptions thrown from the new PDO instantiation level</l>
        $error = '<b>Error message:</b> ' . $e->getMessage();;
    }

<l>// Displaying part</l> ?>

    &lt;?php if ($error): ?>
        &lt;div class="alert alert-danger">&lt;?= $error?>&lt;/div>
    &lt;?php else: ?>
        &lt;p>Latest posts:&lt;/p>
        &lt;ul>
            &lt;?php foreach ($posts_obj as $post): ?>
                &lt;?php $date = new DateTime("@{<b>$post->date_creation</b>}"); ?>
                &lt;li>&lt;?= '&lt;b>' . <b>$post->title</b> . '&lt;/b>' .  
                ' on ' . $date->format('M d, Y (H:i)') . 
                '&lt;div style="font-size:11px;line-height:15px;margin-bottom:5px">' . 
                    <b>$post->content</b> . 
                '&lt;/div>' ?>&lt;/li>
            &lt;?php endforeach; ?>
        &lt;/ul>
    &lt;?php endif; ?>

&lt;?php <l>// End of code</l><?php codeout();

    instruction('Result');

        p('<b>With no error</b>');

            resultin();

                // Logical part

                    $error = null;
                    $dsn = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'data.db';
                    try {
                        $pdo = new PDO(
                            "sqlite:$dsn", null, null, [ 
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                        ]);
                        try { 
                            $query = $pdo->query('SELECT * FROM posts ORDER BY date_creation DESC');
                            $posts_obj = $query->fetchAll();
                        } catch (Exception $e) {
                            $error = '<b>Error message:</b> ' . $e->getMessage();
                        }
                    } catch (PDOException $e) {
                        $error = '<b>Error message:</b> ' . $e->getMessage();;
                    }
                
                // Displaying part ?>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error?></div>
                    <?php else: ?>
                        <p>Latest posts:</p>
                        <ul>
                            <?php foreach ($posts_obj as $post): ?>
                                <?php $date = new DateTime("@{$post->date_creation}"); ?>
                                <li><?= '<b>' . $post->title . '</b>' .  
                                ' on ' . $date->format('M d, Y (H:i)') . 
                                '<div style="font-size:11px;line-height:15px;margin-bottom: 5px">' . 
                                    $post->content . 
                                '</div>' ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                
                    <?php 

                // End of code
            
            resultout();

        p('<b>Database connexion error</b><br>
        (Exception thrown from the PDO instantiation level)');

            resultin();

                // Logical part

                    $error2 = null;
                    $dsn2 = __DIR__ . DIRECTORY_SEPARATOR . 'fddileees' . DIRECTORY_SEPARATOR . 'dffata.db';
                    try {
                        $pdo2 = new PDO(
                            "sqlite:$dsn2", null, null,
                            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
                        );
                        try { 
                            $query2 = $pdo2->query('SELECT * FROM posts ORDER BY date_creation DESC');
                            $posts_obj2 = $query2->fetchAll(PDO::FETCH_OBJ);
                        } catch (PDOException $e2) {
                            $error2 = '<b>Error message:</b> ' . $e2->getMessage();
                        }
                    } catch (PDOException $e2) {
                        $error2 = '<b>Error message:</b> ' . $e2->getMessage();;
                    }
                
                // Displaying part ?>

                    <?php if ($error2): ?>
                        <div class="alert alert-danger"><?= $error2 ?></div>
                    <?php else: ?>
                        <p>Latest posts:</p>
                        <ul>
                            <?php foreach ($posts_obj2 as $post2): ?>
                                <?php $date2 = new DateTime("@{$post2->date_creation}"); ?>
                                <li><?= '<b>' . $post2->title . '</b>' .  
                                ' on ' . $date2->format('M d, Y (H:i)') . 
                                '<div style="font-size:11px;line-height:15px;margin-bottom: 5px">' . 
                                    $post2->content . 
                                '</div>' ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                
                    <?php 

                // End of code
        
            resultout();

        p('<b>With query error</b><br>
        (Exception thrown from the query level: from any method applied to the new PDO instance)');

            resultin();

                // Logical part

                    $error = null;
                    $dsn = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'data.db';
                    $pdo = new PDO(
                        "sqlite:$dsn", null, null,
                        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
                    );
                    try { 
                        $query = $pdo->query('SELECTdfgh * FROM posts ORDER BY date_creation DESC');
                        $posts_obj = $query->fetchAll(PDO::FETCH_OBJ);
                    } catch (Exception $e) {
                        $error = '<b>Error message:</b> ' . $e->getMessage();
                    }
                
                // Displaying part ?>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error?></div>
                    <?php else: ?>
                        <p>Latest posts:</p>
                        <ul>
                            <?php foreach ($posts_obj as $post): ?>
                                <?php $date = new DateTime("@{$post->date_creation}"); ?>
                                <li><?= '<b>' . $post->title . '</b>' .  
                                ' on ' . $date->format('M d, Y (H:i)') . 
                                '<div style="font-size:11px;line-height:15px;margin-bottom: 5px">' . 
                                    $post->content . 
                                '</div>' ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                
                    <?php 

                // End of code
            
            resultout();

anchor('lesson');
title('LESSON');

        p('<b>Database types:</b>
        <ul>
            <li><b>SQLlite</b>: use DB Browser software (for command lines only: SQLite extension for VisualStudioCode) + create a blank .db file (example: data.db)</li>
            <li><b>MySQL</b>: use phpMyAdmin (see lesson <a href="http://www.edouardproust.dev/lessons/20201124_sql_create%20database%20&%20tables">SQL: create database & tables</a></li>
        </ul>
        ');

    anchor('1');
    instruction('1. Connect to an SQL database with PHP');

        p('We create a new instantiation of the PDO class.
        <br>(PHP Reference: <a href=”https://www.php.net/manual/en/book.pdo.php”>PDO</a> > <a href="https://www.php.net/manual/en/pdo.construct.phphttps://www.php.net/manual/en/pdo.construct.php">PDO::__construct</a>)
            ',0,1);

            p('<b>SQLite</b>');
            codein(); ?>
new PDO(‘sqlite:../data.db’);<?php codeout();

            p('<b>MySQL</b>');
            codein(); ?>
&lt;?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
$user = 'dbuser';
$password = 'dbpass';

try { 
    <b>$pdo = new PDO($dsn, $user, $password);</b>
} catch (PDOException $e) { <l>// Use a try/catch to manage exceptions</l>
    echo 'Connection failed: ' . $e->getMessage();
}
?><?php codeout();

    anchor('2');
    instruction('2. Create an SQL query');

        p('This is done via a method. Here are the most frequently used:
            <ul>
                <li><a href=”https://www.php.net/manual/en/pdo.query.php”><b>PDO::query</b></a> — Executes an SQL statement, returning a result set as a <b>PDOStatement object</b>, or <b>false</b> in case of an error. (prefect for <b>SELECT</b> queries)</li>
                <li><a href=”https://www.php.net/manual/en/pdo.exec.php”><b>PDO::exec</b></a> — Execute an SQL statement and return the number of affected rows (attention: pas compatible avec les requêtes SELECT)</li>
                <li><a href=”https://www.php.net/manual/en/pdo.prepare.php”><b>PDO::prepare</b></a> — Allows you to launch a "prepared" query / Prepares a statement for execution and returns a statement object</li>
            </ul>
        ');

        codein() ?>
$pdo = new PDO('sqlite:../data.db');
$query = <b>$pdo->query('SELECT * FROM posts');</b>
if ($query === false) {
    var_dump($pdo-><b>errorInfo()</b>); <l>// Display error message during the development stage</l>
    // do more stuff
}<?php codeout();

    anchor('3');
    instruction('3. Get and send data: the <code>PDOStatement</code> class');

        p('A PDOStatement new object is returned by the <a href=”https://www.php.net/manual/en/pdo.query.php”>PDO::query</a> method, among others.
        ');

        p('<h4>Methods</h4>');

            p('PHP Reference > PDO > <a href="https://www.php.net/manual/en/class.pdostatement.php">PDOStatement</a>
            ',0,1);
            
            p('Most frequently used:
            <ul>
                <li><b><a href="https://www.php.net/manual/en/pdostatement.fetch.php">PDOStatement::fetch</a></b> — Fetches the next row from a result set</li>
                <li><b><a href="https://www.php.net/manual/en/pdostatement.fetchall.php">PDOStatement::fetchAll</a></b> — Returns an array containing all of the result set rows</li>
                <li><b><a href="https://www.php.net/manual/en/pdostatement.fetchcolumn.php">PDOStatement::fetchColumn</a></b> — Returns a single column from the next row of a result set</li>
                <li><b><a href="https://www.php.net/manual/en/pdostatement.execute.php">PDOStatement::execute</a></b> — Executes a prepared statement</li>
            </ul>
            ');
            
            codein() ?>
$dsn = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'data.db';       
try { 
    <b>$pdo = new PDO("sqlite:$dsn");</b>
    <b>$query = $pdo->query('SELECT * FROM posts');</b>
    if ($query === false) { <l>// PDOStatement object returns "false" in case of error</l>
        echo '&lt;b>Query Error:&lt;/b>&lt;pre>'; print_r($pdo->errorInfo()); echo '&lt;/pre>';
    } else {
        <b>$posts = $query->fetchAll();</b>
        echo '<pre>'; var_dump($posts); echo '</pre>'; <l>// Display all the table content in default style</l>
    }
} catch (Exception $e) { <l>// Catch an Exception in case of failure connecting to database</l>
    echo '&lt;b>Connection failed:&lt;/b> ' . $e->getMessage();
}<?php codeout();

        resultin('scroll');
            $dsn = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'data.db';       
            try { 
                $pdo = new PDO("sqlite:$dsn");
                $query = $pdo->query('SELECT * FROM posts');
                if ($query === false) {
                   echo '<b>Query Error:</b><pre>'; print_r($pdo->errorInfo()); echo '</pre>';
                } else {
                    $posts = $query->fetchAll();
                    echo '<pre>'; var_dump($posts); echo '</pre>'; // Display all the table content in default style
                }
            } catch (Exception $e) {
                echo '<b>Connection failed:</b> ' . $e->getMessage();
            }
        resultout();

        p('<h4>fetch_style parameters</h4>');

            p('PHP Reference > PDO > PDOStatement > <a href="https://www.php.net/manual/en/pdostatement.fetch.php">PDOStatement::fetch</a>
            ',0,1);
            
            p('Most frequently used:
            <ul>
                <li>Returns an <b>ARRAY</b>:
                    <ul>
                        <li><b>PDO_FETCH_BOTH</b> (default): returns an array indexed by both column name and 0-indexed column number as returned in your result set</li>
                        <li><b>PDO_FETCH_ASSOC</b> (most used for procedural): returns an array indexed by column name as returned in your result set</li>
                        <li><b>PDO_FETCH_NUM</b>: returns an array indexed by column number as returned in your result set, starting at column 0</li>
                    </ul>
                </li>
                <li>Returns an <b>OBJECT</b>:
                    <ul>
                        <li><b>PDO_FETCH_OBJ</b> (most used for OOP): returns an anonymous object with property names that correspond to the column names returned in your result set (a new instance of the <b>stdClass</b> built-in class is created)</li>
                        <li><b>PDO_FETCH_CLASS</b> : returns a new instance of the requested class, mapping the columns of the result set to named properties in the class, and calling the constructor afterwards, unless PDO::FETCH_PROPS_LATE is also given.</li>
                        <li><b>PDO_FETCH_INTO:</b> : updates an existing instance of the requested class, mapping the columns of the result set to named properties in the class</li>
                    </ul>
                </li>
            </ul>
            ');

            anchor('query-exception-problem');
            codein() ?>
$dsn = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'data.db';       
try { 
    $pdo = new PDO("sqlite:$dsn");
    <l>// Return last posts on top of list: </l>
    $query = $pdo->query('SELECT * FROM posts <b>ORDER BY date_creation DESC</b>'); 
    if ($query === false) {
        echo '&lt;b>Query Error:&lt;/b>&lt;pre>'; print_r($pdo->errorInfo()); echo '&lt;/pre>';
    } else {
        <l>// Return database content into an object:</l> 
        <b>$posts_obj = $query->fetchAll(PDO::FETCH_OBJ);</b>
        ?>
        Latest posts:
        &lt;ul>
            <l>// Go throught each post one by one to extract specific content:</l>
            &lt;?php foreach ($posts_obj as $post): ?>
                <l>// Then display each element separatly:</l>
                &lt;?php $date = new DateTime("@{<b>$post->date_creation</b>}"); ?>
                &lt;li>
                    &lt;?= '&lt;b>' . <b>$post->title</b> . '&lt;/b>' .  
                    ' on ' . $date->format('M d, Y (H:i)') . 
                    '&lt;div style="font-size:11px;line-height:15px;margin-bottom: 5px">' . 
                        <b>$post->content</b> . 
                    '&lt;/div>' ?>
                &lt;/li>
            &lt;?php endforeach; ?>
        &lt;/ul>&lt;?php
    }
} catch (Exception $e) {
    echo '&lt;b>Connection failed:&lt;/b> ' . $e->getMessage();
}<?php codeout(); 

            resultin();
                $dsn = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'data.db';       
                try { 
                    $pdo = new PDO("sqlite:$dsn");
                    $query = $pdo->query('SELECTdf * FROM posts ORDER BY date_creation DESC');
                    if ($query === false) {
                    echo '<b>Query Error:</b><pre>'; print_r($pdo->errorInfo()); echo '</pre>';
                    } else {
                        $posts_obj = $query->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        Latest posts:
                        <ul>
                            <?php foreach ($posts_obj as $post): ?>
                                <?php $date = new DateTime("@{$post->date_creation}"); ?>
                                <li><?= '<b>' . $post->title . '</b>' .  
                                ' on ' . $date->format('M d, Y (H:i)') . 
                                '<div style="font-size:11px;line-height:15px;margin-bottom: 5px">' . 
                                    $post->content . 
                                '</div>' ?></li>
                            <?php endforeach; ?>
                        </ul><?php
                    }
                } catch (Exception $e) {
                    echo '<b>Connection failed:</b> ' . $e->getMessage();
                }
            resultout();

    anchor('4');
    instruction('4. Exceptions management (the <code>PDO::setAttribute</code> method)');

            p('Here is the issue about PDO and Exceptions:
            <ul>
                <li><b>PDO::__construct() throws a PDOException</b> if the attempt to connect to the requested database fails.
                <li><b>On the other hand</b>, if a method fails (for example: $pdo->query) as in the <a href="#query-exception-problem">previous code</a>, the method returns false. This return does not support exceptions by default...</li>
                <li>To get around this problem, there are 2 solutions:
                    <ul>
                        <li><b>Use the <a href="https://www.php.net/manual/en/pdo.setattribute.php" target="_blank">PDO::setAttribute</a> method</b> to make errors returned as new PDOException instead of just returning a "false" statement:
                        ');
                        codein() ?>
<l>// PDO::setAttribute method's signature from PHP.net:</l>

public PDO::setAttribute ( int $attribute , mixed $value ) : bool

<l>// Application example:</l>

$pdo = new PDO("mysql:host=$host; dbname=$dbname", $db_username, $db_password);
$pdo-><b>setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)</b>;
$query = <b>$pdo->query</b>('SELECT * FROM posts ORDER BY date_creation DESC'); 
    <l>// Will return an Exception instead of a fatal error in case of failure</l><?php codeout();
                        p('
                        </li>
                        <li><b>While creating a new instanciation of PDO class: set a 4th parameter</b> (the PDO class\'s <b>constructor</b> allows a <b>array of options</b> as a 4th parameter). Those options correspond to the PDO::setAttribute methode described just before.
                        ');
                        codein() ?>
<l>// PDO class's signature from PHP.net:</l>

public PDO::__construct ( string $dsn [, string $username [, string $passwd [, <b>array $options</b> ]]] )

<l>// Application exemple:</l>

<b>try</b> {
    // Then pass the options as the last parameter in the connection string
    $pdo = new PDO(
        "mysql:host=$host; dbname=$dbname", 
        $db_username, 
        $db_password, 
        <b>[</b> <l>// Here can be set as many attributes as needed into an associative array</l>
            <b>PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION</b>, </l>// That's how to set a failed result as a nex Exception</l>
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
        <b>]</b>
    $query = <b>$pdo->query</b>('SELECT * FROM posts ORDER BY date_creation DESC'); <l>// Will return an Exception instead of a fatal error in case of failure</l>
    );
} <b>catch(PDOException $e)</b> {
    die("Database connection failed: " . $e->getMessage());
}<?php codeout();
                        p('
                        </li>
                    </ul>
                </li>
            </ul>
            ');

    anchor('5');
    instruction('5. Security notice');
        
        p('
        <ol>

            <li><b>Using <a href="https://www.php.net/manual/en/function.htmlentities" target="_blank">htmlentities()</a> function:</b><br>
            To prevent users to put manually html signs inside the URL that may make the page code crash');
            codein(); ?>
<b>// Don't do this:</b>

&lt;ul>
    &lt;?php foreach($posts as $post): ?>
        &lt;li>&lt;a href="/blog/edit.php?=id=&lt;?= $post->id ?>">&lt;?= <b>$post->name</b> ?>&lt;/a>&lt;/li>
    &lt;?php endforeach; ?>
&lt;/ul>

<b>// Do this instead:</b>

&lt;ul>
    &lt;?php foreach($posts as $post): ?>
        &lt;li>&lt;a href="/blog/edit.php?=id=&lt;?= $post->id ?>">&lt;?= <b>htmlentities($post->name)</b> ?>&lt;/a>&lt;/li>
    &lt;?php endforeach; ?>
&lt;/ul><?php codeout();
            p('</li>
            <li><b>Using <a href="https://www.php.net/manual/en/pdo.quote" target="_blank">quote()</a> function on a $_GET call:</b><br>
            While getting data from the database throught a $_GET call, using the following syntax is dangerous, because it allows a hacker to make so-called "SQL injections":');
            codein(); ?>
<b>// Don't do this:</b>

<l>$pdo = new PDO( ... );</l>
try {
    $query = $pdo->query('SELECT * FROM posts WHERE <b>id = ' . $_GET['id']</b>);
    $posts_obj = $query->fetchAll();
}<l> catch (Exception $e) { ... }</l>

<b>// Do this instead:</b>

<l>$pdo = new PDO( ... );</l>
<b>$id = $pdo->quote($_GET['id'])</b>;
try {
    $query = $pdo->query('SELECT * FROM posts WHERE <b>id = ' . $id</b>);
    $posts_obj = $query->fetchAll();
}<l> catch (Exception $e) { ... }</l><?php codeout();
            p('</li>
            <li>The other solution is to use a <b><a href="https://www.php.net/manual/en/pdo.prepare" target="_blank">PDO::prepare</a> + <a href="https://www.php.net/manual/en/pdostatement.execute.php" target="_blank">PDOStatement::execute</a> methods</b>:<br>
            ');
            codein(); ?>
$pdo = new PDO( ... );
<l>// step 1: prepare query with a undefined variable</l>
$query = $pdo-><b>prepare</b>('SELECT * FROM posts WHERE id = </b>:id</b>');
<l>// step 2: define variable and execute</l>
$query-><b>execute</b>([
    <b>'id' => $_GET['id']</b>
]);
$post = $query->fetch();<?php codeout();
            p('</li>');
            
        p('</ol>');
    
    anchor('6');
    instruction('6. Make several queries at once (transactions)');

        p('Transactions must be used each time we have more than 1 query from or to the database.
        <br><br>
        <b>Methods to use:</b>
        <ul>
            <li><a href="https://www.php.net/manual/en/pdo.begintransaction" target="_blank"><b>PDO::beginTransaction</b></a>: Initiates a transaction</li>
            <li><a href="https://www.php.net/manual/en/pdo.commit" target="_blank"><b>PDO::commit</b></a>: Commits a transaction</li>
            <li><a href="https://www.php.net/manual/en/pdo.begintransaction" target="_blank"><b>PDO::rollBack</b></a>: Rolls back a transaction. Very usefull to avoid damaging the database if bad queries happened</li>
        </ul>');

        codein(); ?>
$pdo = new PDO("sqlite:$dsn", null, null, [ 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
<b>try</b> {
    $pdo-><b>beginTransaction()</b>;
        $pdo->exec('UPDATE posts SET name = "Test title" WHERE id = 3');
        $pdo->exec('UPDATE posts SET content = "Test content" WHERE id = 3');
        $post = $pdo->query('SELECT * FROM posts WHERE id = 3')->fetch();
    $pdo-><b>commit()</b>;
    echo '&lt;b>Updated post data:&lt;/b>';
    var_dump($post);
} <b>catch</b> (Exception $e) {
    $pdo-><b>rollback()</b>;
    echo '&lt;b>No change has been made to database due to a processing error:&lt;/b>&lt;br>' .
        $e->getMessage();
}<?php codeout();

        resultin();
            $pdo = new PDO("sqlite:$dsn", null, null, [ 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            try {
                $pdo->beginTransaction();
                    $pdo->exec('UPDATE posts SET name = "Test title" WHERE id = 3');
                    $pdo->exec('UPDATE posts SET content = "Test content" WHERE id = 3');
                    $post = $pdo->query('SELECT * FROM posts WHERE id = 3')->fetch();
                $pdo->commit();
                echo '<b>Updated post data:</b><pre>';
                    var_dump($post);
                    echo '</pre>';
            } catch (Exception $e) {
                $pdo->rollback();
                echo 
                    '<b>No change has been made to database due to a processing error:</b><br>' .
                    $e->getMessage();
            }
        resultout();

        p('Now if we change "name" by "title" as it is in the table:');

        resultin();
            $pdo = new PDO("sqlite:$dsn", null, null, [ 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            try {
                $pdo->beginTransaction();
                    $pdo->exec('UPDATE posts SET title = "Test title" WHERE id = 3');
                    $pdo->exec('UPDATE posts SET content = "Test content" WHERE id = 3');
                    $post = $pdo->query('SELECT * FROM posts WHERE id = 3')->fetch();
                $pdo->commit();
                echo '<b>Updated post data:</b><pre>';
                    var_dump($post);
                    echo '</pre>';
            } catch (Exception $e) {
                $pdo->rollback();
                echo 
                    '<b>No change has been made to database due to a processing error:</b><br>' .
                    $e->getMessage();
            }
        resultout();

    anchor('7');
    instruction('7. A few more usefull methods');

        p('<ul>
            <li><a href="https://www.php.net/manual/en/pdo.lastinsertid.php" target="_blank"><b>PDO::lastInsertId</b></a>: Returns the ID of the last inserted row or sequence value</li>
        </ul>');

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?> 