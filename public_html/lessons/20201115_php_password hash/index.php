<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/password-hash-1132');

// START EDITING

title('Lesson'); // '1' or '2' for preset titles

    instruction('Purpose');

        p('For security reasons, it is forbidden to store clear passwords directly in the page code or in a database.'
        );

    instruction('Why we chose to hash the password');
    
        p('There are two solutions to secure passwords:

        <ol>

            <li><b>Encryption:</b> functions modifying the password (e.g. replacing 
            characters with other characters according to a set of predefined rules).</li>

            <li><b>Hashing:</b> Generating a signature for a string of characters. 
            Signature = description of the characteristics of the password 
            (example: length, type, etc. but in a more complex version). 
            The result is a string of characters, a kind of code, which 
            allows you to check if an entered password matches the signature. 
            It is not possible to find the password in reverse.</li>
            
        </ol>'
        );
    
    instruction('Hash functions');
    
        p('There are 2 functions in PHP to hash passwords:

        <ol>

            <li><b>password_hash()</b>: to generate a signature based on a password 
            (<a href="https://www.php.net/manual/en/function.password-hash.php" target="_blank">PHP Doc</a>)</li>

            <li><b>password_verify()</b>: to verify if the password matches a given signature 
            (<a href="https://www.php.net/manual/en/function.password-verify.php" target="_blank">PHP Doc</a>)</li>
        
        </ol>
        Both functions are detailed below.');
        
    instruction('1. password_hash()');

        p('<ul>

            <li>$var1: <b>password</b></li>

            <li>$var2: <b>algorithm</b> to use. We use the constants listed on this page: 
            <a href="https://www.php.net/manual/en/function.password-hash.php" 
            target="_blank">PHP Doc</a>. Very often the default value (PASSWORD_DEFAULT) is used.</li>

            <li>$var3: <b>salt</b> (quite never used) and <b>cost</b>. The cost allows to increase the time to generate the signature 
            (this will make it more time/difficult for a hacker to decrypt the password). 
            By default, the cost is 10. The higher this number is, the longer it will 
            take the processor to generate a signature. In 2020 we tend to put a cost of 13.</li>
        
        </ul>');
    
        codein(); ?>
echo password_hash('Doe', PASSWORD_DEFAULT, ['cost' => 13]);<?php codeout();
    
        p('<b>Output:</b> the password_hash() function returns a string which is the <b>signature</b> of the password:');

        resultin('scroll'); 
            echo $signature = password_hash('Doe', PASSWORD_DEFAULT, ['cost' => 13]);
        resultout();

        p('
        <ul>
            <li>In the above signature generated, the cost is <b>$13</b> (4th position).</li>
            <li>Now that we have generated the password signature, we want to check if the password entered by the user matches the signature.</li>
        </ul>
        ');

    instruction('2. password_verify()');
        
        p('<ul>
            <li>$var1: <b>password</b> entered by the user.</li>
            <li>var2: <b>signature</b> (previously generated with password_hash)</li>
        </ul>'
        );
    
        codein(); ?>
<l>// Instead of doing the verification this way (unsecured)...</l>
    
if ($_POST['password'] === 'Doe') {<l>
    /* do something */</l> 
}
    
<l>// ...we use this (secure version with hash):</l>
    
$signature = '<?= $signature ?>';
if (password_verify($_POST['password'], $signature])) {<l> 
    /* do something */</l>
}<?php codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>