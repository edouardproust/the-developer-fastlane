<?php
require '../../includes/header.php';
get_post_head('https://youtu.be/pcunj2FI_-c?t=1811');

// START EDITING

title('Ice cream shop price generator');

    p('<b>Video:</b> Go to the exercise instructions → <a href="https://youtu.be/pcunj2FI_-c?t=1811" target="_blank">30:11</a>');
    
    accordionin();
        accordionli('
        Instructions','
        
            The goal of this program is to calculate the price of an ice-cream based on the client choices. We provide a bunch of options to customize one\'s ice-cream. Below are the options available:<br>
            <div class="paragraph">
                <b>Flavour:</b>
                <ul>
                    <li>Strawberry: $4</li>
                    <li>Chocolate: $5</li>
                    <li>Vanilla: $3</li>
                </ul>
            </div>
            <div class="paragraph">
                <b>Cone</b>
                <ul>
                    <li>Bucket: $2</li>
                    <li>Cone: $3</li>
                </ul>
            </div>
            <div class="paragraph">
                <b>Extra topping:</b>
                <ul>
                    <li>Chocolate chip: $1</li>
                    <li>Caramel: $1.5</li>
                    <li>Whipped cream: $0.5</li>
                </ul>
            </div>
            <br>
            Last instruction: we want the client to be able to share his/her choice with a friend. So we need to use the "GET" method.');
    accordionout();
    

title('My solution');

    instruction('Result:');

        resultin();

        // LOGICAL PART -----------------

            // VARIABLES INIT.

                $form = [
                    'flavour' => [
                        ['strawberry', 4, 'checkbox'],
                        ['chocolate', 5, 'checkbox'],
                        ['vanilla', 3, 'checkbox'],
                        ['melon', 5, 'checkbox']
                    ],
                    'cone' => [
                        ['bucket', 2, 'radio'],
                        ['cone', 3, 'radio']
                    ],
                    'extra-topping' => [
                        ['chocolate-chip', 1, 'checkbox'],
                        ['caramel', 1.5, 'checkbox'],
                        ['whipped-cream', 0.5, 'checkbox']
                    ]
                ];    
            
                $error = [];
                $error_global = null;
                $cart = null;
                $i=0;

            // FUNCTIONS

                function format_label($field_name) {
                    return ucfirst( str_replace( '-', ' ', $field_name ) );
                }
                function global_error() { // Generate an error message if no field is set after clicking on "Validate"
                    $exploded= explode('?', $_SERVER["REQUEST_URI"]);
                    if ( end($exploded) == null ) {
                        $error_global = "<div class='error form'>You didn't chose any options!</div>"; 
                        return $error_global;
                    }
                }
                foreach ( $form as $cat => $options ) {
                    foreach ( $options as $data ) { 
                        if ($_GET != null && !isset($_GET[$cat])) { // Generate error text for each options category
                            if ($data[2] === 'radio') {
                                $error[$cat] = "<div class='error form'>Please chose an option.</div>";
                            }
                            elseif ($data[2] === 'checkbox') {
                                $error[$cat] = "<div class='error form'>Please chose at least one option.</div>";
                            }
                        }
                        if( in_array($data[0], $_GET[$cat]) ) { // Generate an array to display the cart modal
                            $cart[$i][] = $cat;
                            $cart[$i][] = $data[0];
                            $cart[$i][] = $price[] = $data[1]; // add price to array in aim to calculate the rice
                            $i++;
                        }
                    }
                }
            

        // DISPLAYING PART -----------------

            // CART MODAL

                if( $cart != null && $error == null ) { ?>
                    <div class="modal overlay">
                        <div class="modal popup">
                            <h2>Cart</h2>
                            <a class='modal close' href='<?= $_SERVER["PHP_SELF"] ?>'>&times;</a>
                            <div class="modal content">
                                <b>Your choice:</b>
                                <ul>
                                    <?php foreach ($cart as $i => $data) { ?>
                                        <li><?= format_label($cart[$i][0]) . ': <b>' . format_label($cart[$i][1]) . '</b> ($' . $cart[$i][2] .')'?></li>
                                    <?php } ?>
                                </ul>
                                <p class='modal cart center'>Order total: <span class='modal price'>$<?= array_sum($price) ?></span></p>
                                <form action='#' method='POST' class='form-exo center'>
                                    <button type='submit'>Go to Checkout</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }

            // FORM
            
                ?><div class="lottie right">
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_VCStus.json"  speed=".5"  style="width: 120px; height: 120px;"  loop  autoplay></lottie-player>
                </div>
                <h4>Create your ice cream:</h4>
                <form action='<?= $_SERVER["REQUEST_URI"] ?>' method='GET' class='form-exo' ><?php
                echo global_error();
                    foreach ( $form as $cat => $options ) {
                        ?><div class='form-exo-title'><?= format_label($cat) ?></div>
                        <?= $error[$cat] ?><?php
                            foreach ( $options as $data ) {
                            ?><div> 
                                <input type='<?= $data[2] ?>' name='<?= $cat . '[]' ?>' value='<?= $data[0] ?>' <?php 
                                    if( in_array($data[0], $_GET[$cat]) ) { 
                                    echo 'checked'; // Keep the field field/ checked
                                    } ?>
                                >
                                <label><?= format_label($data[0]); ?></label>
                                <price><?= $data[1] ?></price>
                            </div><?php
                        }
                    }
                ?>
                <button type='submit'>Validate my choice</button>
            </form><?php


        resultout();


    instruction('Code:');

    p('PHP');
        codein(null); ?>
// LOGICAL PART -----------------

    // VARIABLES INIT.

        $form = [
            'flavour' => [
                ['strawberry', 4, 'checkbox'],
                ['chocolate', 5, 'checkbox'],
                ['vanilla', 3, 'checkbox'],
                ['melon', 5, 'checkbox']
            ],
            'cone' => [
                ['bucket', 2, 'radio'],
                ['cone', 3, 'radio']
            ],
            'extra-topping' => [
                ['chocolate-chip', 1, 'checkbox'],
                ['caramel', 1.5, 'checkbox'],
                ['whipped-cream', 0.5, 'checkbox']
            ]
        ];    

        $error = [];
        $error_global = null;
        $cart = null;
        $i=0;

    // FUNCTIONS

        function format_label($field_name) {
            return ucfirst( str_replace( '-', ' ', $field_name ) );
        }
        function global_error() { // Generate an error message if no field is set after clicking on "Validate"
            $exploded= explode('?', $_SERVER["REQUEST_URI"]);
            if ( end($exploded) == null ) {
                $error_global = "&ltdiv class='error form'>You didn't chose any options!&lt/div>"; 
                return $error_global;
            }
        }
        foreach ( $form as $cat => $options ) {
            foreach ( $options as $data ) { 
                if ($_GET != null && !isset($_GET[$cat])) { // Generate error text for each options category
                    if ($data[2] === 'radio') {
                        $error[$cat] = "&ltdiv class='error form'>Please chose an option.&lt/div>";
                    }
                    elseif ($data[2] === 'checkbox') {
                        $error[$cat] = "&ltdiv class='error form'>Please chose at least one option.&lt/div>";
                    }
                }
                if( in_array($data[0], $_GET[$cat]) ) { // Generate an array to display the cart modal
                    $cart[$i][] = $cat;
                    $cart[$i][] = $data[0];
                    $cart[$i][] = $price[] = $data[1]; // add price to array in aim to calculate the rice
                    $i++;
                }
            }
        }


// DISPLAYING PART -----------------

    // CART MODAL

        if( $cart != null && $error == null ) { ?>
            &ltdiv class="modal overlay">
                &ltdiv class="modal popup">
                    &lth2>Cart&lt/h2>
                    &lta class='modal close' href='&lt?= $_SERVER["PHP_SELF"] ?>'>&times;&lt/a>
                    &ltdiv class="modal content">
                        &ltb>Your choice:&lt/b>
                        &ltul>
                            &lt?php foreach ($cart as $i => $data) { ?>
                                &ltli>&lt?= format_label($cart[$i][0]) . ': &ltb>' . format_label($cart[$i][1]) . '&lt/b> ($' . $cart[$i][2] .')'?>&lt/li>
                            &lt?php } ?>
                        &lt/ul>
                        &ltp class='modal cart center'>Order total: &ltspan class='modal price'>$&lt?= array_sum($price) ?>&lt/span>&lt/p>
                        &ltform action='#' method='POST' class='form-exo center'>
                            &ltbutton type='submit'>Go to Checkout&lt/button> 
                        &lt/form>
                    &lt/div>
                &lt/div>
            &lt/div>
        &lt?php }

    // FORM

        ?>&ltdiv class="lottie right">
            &ltlottie-player src="https://assets8.lottiefiles.com/packages/lf20_VCStus.json"  speed=".5"  style="width: 120px; height: 120px;"  loop  autoplay>&lt/lottie-player>
        &lt/div>
        &lth4>Create your ice cream:&lt/h4>
        &ltform action='&lt?= $_SERVER["REQUEST_URI"] ?>' method='GET' class='form-exo' >&lt?php
        echo global_error();
            foreach ( $form as $cat => $options ) {
                ?>&ltdiv class='form-exo-title'>&lt?= format_label($cat) ?>&lt/div>
                &lt?= $error[$cat] ?>&lt?php
                    foreach ( $options as $data ) {
                    ?>&ltdiv> 
                        &ltinput type='&lt?= $data[2] ?>' name='&lt?= $cat . '[]' ?>' value='&lt?= $data[0] ?>' &lt?php 
                            if( in_array($data[0], $_GET[$cat]) ) { 
                            echo 'checked'; // Keep the field field/ checked
                            } ?>
                        >
                        &ltlabel>&lt?= format_label($data[0]); ?>&lt/label>
                        &ltprice>&lt?= $data[1] ?>&lt/price>
                    &lt/div>&lt?php
                }
            }
        ?>
        &ltbutton type='submit'>Validate my choice&lt/button>
    &lt/form>&lt?php

<?php codeout();
    p('CSS');
        codein(null); ?>
:root{
    --form-exo-primary: #60a340;
    --form-exo-secondary: #fff;
}
.form-exo-title {
    padding: 25px 0 0px 0;
    margin-bottom: -5px;
    font-weight: 700;
    font-size: 11px;
    text-transform: uppercase;
    opacity: .6;
}
.form-exo button {
    margin: 35px 0 10px 0;
    background-color: var(--form-exo-primary);
    color: var(--form-exo-secondary);
    font-weight: 700;
    border: none;
    padding: 10px 30px;
    border-radius: 4px;
}
.form-exo button:hover {
    cursor: pointer;
    opacity: 0.8;
    transition: .5s;
}
.form-exo > div {
    height: 25px;
}
.form-exo > div label {
    padding-left: 5px;
}
.form-exo > div price {
    margin-left: 5px;
    background-color: var(--form-exo-primary);
    font-size: 14px;
    font-weight: 600;
    color: var(--form-exo-secondary);
    padding: 4px 5px 2px 5px;
    border-radius: 100px;
}
.form-exo > div > price::before {
    content:'$';
    vertical-align: super;
    padding-right: 1px;
    font-weight: 400;
    padding-top: 3px;
    font-size: 10px;
}
.lottie.right  {
        position: relative;
        float: right;
        padding-left: 20px;
}

@media (max-width: 700px ) {

    .lottie.right  {
        position: static;
        float: none;
        padding-left: 0;
    }
    .lottie lottie-player {
        width: 100%;
        margin: auto;
    }

}<?php codeout();

title('The teacher\'s solution');

    p("Click <a href='/lessons/unlisted/php_forms (correction)_20201023.php'>here</a> to see it");

// STOP EDITING
        
require '../../includes/footer.php'; 

?>