<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/file-get-contents-1125');

// START EDITING

title(1); // '1' or '2' for preset titles (1 = course / 2 = exercise)

    instruction('New learned notions (summury)');

        p('
            <ol>
                <li><h4>Files relative path</b> constants and operators:</h4>
                    <ul>
                        <li><b>__DIR__</b> magic constant
                         (<a href="https://www.php.net/manual/en/language.constants.predefined.php" target="_blank">PHP doc</a>)</li>
                        <li><b>dirname()</b> function: allows to target the upper folder.
                         (<a href="https://www.php.net/manual/en/function.dirname.php" target="_blank">PHP doc</a>)</li>
                        <li><b>DIRECTORY_SEPARATOR</b> predifined constant: allows to change the folders path separator depending on the operating system the PHP server is on: "\" for windows, "/" for MAC or Linux.
                         (<a href="https://www.php.net/manual/en/dir.constants.php" target="_blank">PHP doc</a>)</li> 
                        <li><b>@</b> error control operator: putting the "@" sign right to the left of a function name will mute any warning message the function would return in case of an error.
                         (<a href="https://www.php.net/manual/en/language.operators.errorcontrol.php" target="_blank">PHP doc</a>)</li>
                    </ul>
                </li>
                <li><h4>Reading a file</h4>
                    <ul>
                        <li><b>file_get_contents()</b> function: returns the entire called file as a textual string. Put in another way: it gets the content of a file and display it directly inside the code). <b>Important:</b> This function must call only internal files, not external http:// links.
                        (<a href="https://www.php.net/manual/en/function.file-get-contents.php" target="_blank">PHP doc</a>)</li>
                        <li><b>file()</b> function: returns an array (one row for each file\'s line).
                         Retuns an array, so we are able to call a specifical line of the file (see example below).
                         (<a href="https://www.php.net/manual/en/function.file.php" target="_blank">PHP doc</a>)</li>
                        <li><b>fopen()</b> + <b>fgets()</b> + <b>fclose()</b> functions: The best solution to read <b>heavy files</b> (too big for the server memory size).
                            <ul>
                                <li>For fopen() we use the "<b>r</b>" option for "read only" the file.
                                <a href="https://www.php.net/manual/en/function.fopen.php" target="_blank">PHP doc</a>)</li>
                                <li>Then we create a <b>loop</b> with the fgets() function to target a specific line (see the code example below).
                                (<a href="https://www.php.net/manual/en/function.fgets.php" target="_blank">PHP doc</a>)</li>
                                <li>Finally, we <b>close</b> the file reading with the fclose() function.
                                (<a href="https://www.php.net/manual/en/function.fclose.php" target="_blank">PHP doc</a>)</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><h4>Writing inside a file</h4>
                    <ul>
                        <li><b>file_put_contents()</b> function: create a new file inside the defined folder path (if it doesn\'t exist) or override it (if it already exist).
                         Returns the size of the file created (in octets) or "false in case of an error to write the file.
                         (<a href="https://www.php.net/manual/en/function.file-put-contents.php" target="_blank">PHP doc</a>)</li>
                        <li><b>fopen()</b> + <b>fgets</b> + <b>fwrite</b> + <b>fclose()</b> functions: The best solution to write inside <b>heavy files</b> (too big for the server memory size).
                        This is the same logic as for the "reading heavy files" tecnic above. The 2 differences are:
                        <ul>
                            <li>For fopen() we use the "<b>r+</b>" option for "read and write" the file (instead of "r" for reading only).
                            <a href="https://www.php.net/manual/en/function.fopen.php" target="_blank">PHP doc</a>)</li>
                            <li>We add the fwrite() function inside the fgets() loop, to write inside the file.
                            (<a href="https://www.php.net/manual/en/function.fwrite.php" target="_blank">PHP doc</a>)</li>
                        </ul>
                    </ul>
                </li>
            </ol>
        ');

    instruction('Examples');

        codein(null); ?>

<b>// FILES RELATIVE PATHS</b>

    $file1 = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'demo.txt';<l>
        // Returns: <b>C:\MAMP\htdocs\becoming-a-developer\demo.txt</b></l>

    $file2 = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'demo.txt';<l>
        // Returns: <b>C:\demo.txt</b></l>


<b>// CREATE A FILE AND WRITE INSIDE</b>

    file_put_contents($file1, 'Hello');<l>
        // Will create the demo.txt file if it doesn't exist inside the following folder: C:\MAMP\htdocs\becoming-a-developer
        // And will add <b>"Hello"</b> as text inside the file</l>

    file_put_contents($file1, ' world!', FILE_APPEND);<l>
        // Will Add " world!" as text at the end of the "demo.txt" file (as it now exists)
        // Result: <b>"Hello world!"</b></l>

    file_put_contents(<b>$file2</b>, 'Hello');<l>
        // This time, the function will return an <b>error</b> because the current user doesn't have <b>writting rights</b> on this folder (C:\ is a vital folder for the operating system).</l>


<b>// READING A FILE</b>

    echo <b>file_get_contents</b>($file1);<l>
        // Injects the file's <u>whole</u> content inside the page code</l>

    $lines = <b>file</b>($file1);
    echo $lines[0];<l>
        // Will inject the <u>first line</u> of the called file inside the code</l>
    <?php codeout();

        instruction('Preventing error messages while writing a file');

            codein(null); ?>
    $size = <b>@</b>file_put_contents($file2, 'Hello');<l>
        // The "@" sign put before a function mute any error message in case the function returns an error</l>
    <b>if ($size === false)</b> { <l>
        // The "file_put_contents()" function returns the size of the written file OR "false" in case of an error</l>
        echo "An error occured while writing the file."
    } else {
        echo "Success!"
    }<l><?php codeout();

        instruction('Reading heavy files');

            codein(null); ?>
$resource = <b>fopen($file1, 'r')</b>;
$k = 0;
while ($line = <b>fgets($resource)</b>) {
    $k++;
    if ($k == 1200) { <l>// This will echo the line nr.1200 of the file without taking much server memory</l>
        echo $line;
        break;
    }
}
<b>fclose($resource)</b>; <l>// it's important not to forget to close the file at the end of the process</l>
<l>
/* Important notice:
 * fgets() function returns "false" when the end of the file is reached by the while(true) loop,
 * which break it automaticaly. */</l>
<?php codeout();

    instruction('Writing inside heavy files');

        codein(null); ?>
$resource = fopen($file1, <b>'r+'</b>); <l>// 1st difference with the "Read only" method: we put "r+" as an option, instead of "r"</l>
$k = 0;
while ($line = <b>fgets($resource)</b>) {
    $k++;
    if ($k == 1200) {
        <b>fwite($resource, "Some text to replace existing one")</b>; <l>
            // Second difference with the "Read only" method: we replace the echo function by the fwrite() one, in aim to write inside the file</l>
        break;
    }
}
<b>fclose($resource)</b>;
<l>
/* Important notice:
 * fwrite() function writes ON the existing text, not between. So it will replace the existing text. This is why we'll use rarely this method. 
 * To write inside the file without overriding existing text, we need to use quite complexe methods, we won't talk about here. */</l>
<?php codeout();


    instruction('Bonus: save a line of code!');

        codein(null); ?>
<b>echo ($var = 3);</b><l>
// replaces the following:</l>
    $var = 3;
    echo $var;

<b>while ($line = fgets($resource))</b> { ... }<l>
// replaces the following:</l>
    $line = fgets($resource);
    while ($line) { ... }<?php codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/*  

code for "<": &lt;
accordionin();
    accordionli('
    Title','
        Content<br>
        <br><b>List</b>
        <ul>
            <li>li element</li>
        </ul>
    ');
accordionout();
 */

?>