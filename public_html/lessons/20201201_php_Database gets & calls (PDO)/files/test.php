<?php

title('LESSON');

instruction('Types de base de données:');

p('
<ul>
    <li>SQLlite: utilisation du logiciel DB Browser (pour seulement les lignes de commandes: extension SQLite pour VisualStudioCode) + créer un fichier vierge .db (exemple: data.db)</li>
    <li>MySQL: utiliser phpMyAdmin (voir la lesson <a href="http://www.edouardproust.dev/lessons/20201124_sql_create%20database%20&%20tables">SQL: create database & tables</a></li>
</ul>
');

instruction('1. Lier la base de donnée via PHP');

    p('<h4>1. Nouvelle instance de PDO</h4>');
    p('PHP Reference: <a href=”https://www.php.net/manual/en/book.pdo.php”>PDO</a> > <a href="https://www.php.net/manual/en/pdo.construct.phphttps://www.php.net/manual/en/pdo.construct.php">PDO::__construct</a>
    ', 0, 1);

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

instruction('2. Créer une requête SQL');

    p('Cela est réalisé via une méthode. Voici les plus fréquemment utilisées:
        <ul>
            <li><a href=”https://www.php.net/manual/en/pdo.query.php”><b>PDO::query</b></a> — Executes an SQL statement, returning a result set as a <b>PDOStatement object</b>, or <b>false</b> in case of an error. (prefect for <b>SELECT</b> queries)</li>
            <li><a href=”https://www.php.net/manual/en/pdo.exec.php”><b>PDO::exec</b></a> — Execute an SQL statement and return the number of affected rows (attention: pas compatible avec les requêtes SELECT)</li>
            <li><a href=”https://www.php.net/manual/en/pdo.prepare.php”><b>PDO::prepare</b></a> — Permet de lancer une requête dite “preparée” / Prepares a statement for execution and returns a statement object</li>
        </ul>
    ');

    codein() ?>
$pdo = new PDO('sqlite:../data.db');
$query = <b>$pdo->query('SELECT * FROM posts');</b>
if ($query === false) {
    var_dump($pdo-><b>errorInfo()</b>); <l>// Display error message during the development stage</l>
    // do more stuff
}<?php codeout();

instruction('Get and send data: the <code>PDOStatement</code> class');

    p('PHP Reference > PDO > PDOStatement</a><br>
    A PDOStatement new object is returned by the <a href=”https://www.php.net/manual/en/pdo.query.php”>PDO::query</a> method, among others.
    ',0,1);

    p('<b>Methods list:</b>
        <ul>
            <li><b>PDOStatement::execute</b> — Dans le cadre d\'une "requête préparée"</li>
            <li><b>PDOStatement::execute</b> — Executes a prepared statement</li>
            <li><b>PDOStatement::fetch</b> — Fetches the next row from a result set</li>
            <li><b>PDOStatement::fetchAll</b> — Returns an array containing all of the result set rows</li>
            <li><b>PDOStatement::fetchColumn</b> — Returns a single column from the next row of a result set</li>
        </ul>
    ');