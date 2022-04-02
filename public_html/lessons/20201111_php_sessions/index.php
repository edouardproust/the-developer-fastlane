<?php
require '../../includes/header.php';
get_post_head('https://www.grafikart.fr/tutoriels/session-php-1128');

// START EDITING

title('Lesson'); // '1' or '2' for preset titles

    instruction('What is it? / What is it for?');

        p('
            <ul>
                <li>The <b>session</b> is used to save personal 
                and sensitive informations about the user, 
                that musn\'t be modified by him / that he musn\'t have access to.</li>
                <li>Difference between <b>session</b> and <b>cookies</b>:
                    <ul>
                        <li>Sessions are kind of cookies but in a "top secret" mode: <b>impossible for the user to read or modify content</b>.</li>
                        <li>As for cookies, <b>it modifies headers sent back to the browser</b>: 
                        so it important to <b>not display any 
                        content on the page before this function is called.</b></li>
                        <li>Unlike the session, cookies are used for non-sensitive informations, as they can be modified by the user.</li>
                    </ul>
                </li>
            </ul>
        ');

    instruction('Functions and variables');

        p('
            <ul>
                <li><b>session_start()</b> function initialises the session 
                (<a href="https://www.php.net/manual/en/function.session-start.php" target="_blank">PHP Doc</a>)</li>
                <li><b>$_SESSION</b> super / global variable: allows to modify and to read the infos inside the session. 
                (<a href="https://www.php.net/manual/en/reserved.variables.session" target="_blank">PHP Doc</a>)
                    <ul>
                        <li>It stores infos on the session as an array: unlike cookies, session allows complex infos as an array</li>
                        <li>No need to use serialize() and unserialize() function then (as for cookies) to work with sessions data.</li>
                    </ul>
                </li>
                <li>In general (99% of the cases), the other functions and variables <a href="https://www.php.net/manual/en/ref.session.php" target="_blank">listed on PHP.net</a> about session are not usefull. <b>Only the previous 2 will be used in most cases</b>.</li>
            </ul>
        ',0,0);

        p('Example:');

            codein(); ?>
session_start(); <l>// 1. Session init.</l>
$_SESSION['role'] = "administrator"; <l>2. Creating a new role for admins<?php codeout();


    instruction('How does it works (technical side)?');

    p('
        <ul>
            <li>Creates a kind of indetifier in a cookies called <b>PHPSESSID</b>
            (that can be found under google chrome browser > inspector > "applications" tab > "cookies" sidebar submenu > clic on the domain name)</li>
            <li>Infos are not stored on cookie side, but <b>stored on the server side</b>: imposible to be changed by the user.</li>
            <li>The session <b>will ends when the browser is closed by the user</b>.</li>
            <li>To go further on how session works: follows this <a href="https://www.grafikart.fr/tutoriels/session-start-825" target="_blank">additional course</a></li>
        </ul>
    ');

    instruction('Some advices for good use');

    p('
        <ul>
            <li><b>Do not use session_start() function if not used in the script</b> (some developpers use it by default, just in case). This is a bad habit because the session_start function is quite demanding (heavy) for the server, and <b>will reduce the app performance</b>.</li>
        </ul>
    ');

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>