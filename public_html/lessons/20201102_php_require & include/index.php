<?php
require '../../includes/header.php';
get_post_head('Change this URL');

// START EDITING

    title(1);

    p('<b>Both include(), require() and require_once() are functions that call and read an external file.</b>
    <ul>
        <li>They allow us to write code only once and to call it as many times as we want.</li>
        <li>This helps to reduce the script length and make it more understandable and easy to update (files and folders hierarchy).</li>
        <li>They can be used inside user-defined functions too.</li>
    </ul>
    Below is a list of them, <b>sorted by use-frequency</b> (from the most commonly used to the most rarely used), with their own specs detailed:
        <h3>require()</h3>
        <ul>
            <li><b>Use case(s):</b>
                <ul>
                    <li>Used <u>by default</u></li>
                    <li><b>IF</b> the called-file contains user-defined functions or classes definitions, <b>THEN</b> we must be sure it will be called <b>only once</b> inside the whole script (if not, then better use <b>require_once</b> instead)</li>
                </ul>
            </li>
            <li><b>Block the current script:</b> Yes</li>
            <li><b>Fatal error message:</b> Yes
                <ul>
                    <li><b>Display:</b>
                        <ul>
                            <li>A "Fatal error message" if errors-display is activated inside the browser/server</li>
                            <li>A "500 error" page if not.</li>
                        </ul>
                    </li>
                    <li><b>In which case(s)?</b>
                        <ul>
                            <li>The file has not been found inside the declared repository location</li>
                            <li><b>OR</b> the called-file contains functions / classes and has been called more than once inside the whole script
                        </ul>
                    </li>
                </ul>    
            </li>
        </ul>
        <h3>require_once()</h3>
        <ul>
            <li><b>Use case(s):</b>
                <ul>
                    <li>Used <u>by default</u></li>
                    <li><b>AND</b> the called-file contains user-defined functions or classes definitions</li>
                    <li><b>AND</b> the file may be called <b>more than once</b> inside the whole script</li>
                </ul>
            </li>
            <li><b>Block the current script:</b> Yes</li>
            <li><b>Fatal error message:</b> Yes
                <ul>
                    <li><b>Display:</b> Same as for require().</li>
                    <li><b>In which case(s)?</b> The file has not been found inside the declared repository location</li>
                </ul>
        </ul>
        <h3>include()</h3>
        <ul>
            <li><b>Use case(s):</b>
                <ul>
                    <li>You are not sure the called-file exists</li>
                    <li><b>AND</b> the called-file won\'t cause security holes inside the code if it was not found.</li>
                    <li><b>AND</b> you don\'t want to block the script in case of an error.</li>
                </ul>
            </li>
            <li><b>Block the current script:</b> No</li>
            <li><b>Fatal error message:</b> No
                <ul>
                    <li><b>Display:</b> Only a <b>"warning" message</b></li>
                    <li><b>In which case(s)?</b> Same as for require()
                </ul>
        </ul>
        <h3>include_once()</h3>
        <ul>
            <li><b>Use case(s):</b>
                <ul>
                    <li>Same as for include()</li>
                    <li><b>AND</b> the called-file contains user-defined functions or classes definitions</li>
                    <li><b>AND</b> the file may be called <b>more than once</b> inside the whole script</li>
                    <li><b>AND</b> you want to optimise the script by preventing the server to read the file several times.</li>
                </ul>
                </ul>
            <li><b>Block the current script:</b> No</li>
            <li><b>Fatal error message:</b> No
                <ul>
                    <li><b>Display:</b> Same as for include()</li>
                    <li><b>In which case(s)?</b> Same as for require_once()
                </ul>
            </li>
        </ul>');

// STOP EDITING
        
require '../../includes/footer.php'; 

?>