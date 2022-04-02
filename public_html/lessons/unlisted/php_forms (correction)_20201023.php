<?php
require '../../includes/header.php';
get_post_head('https://youtu.be/pcunj2FI_-c?t=1811');

// START EDITING

    instruction('Result:');

        resultin();


            // Checkbox
            $flavours = [
                'Strawberry' => 4,
                'Chocolate' => 5,
                'Vanilla' => 3
            ];

            // Radio
            $cones = [
                'Bucket' => 2,
                'Cone' => 3
            ];

            // Checkbox
            $extraToppings = [
                'Chocolate chip' => 1,
                'Whiped cream' => 0.5
            ];


            // Variables
            $this_page = $_SERVER["REQUEST_URI"];
            $checked = null;
            $ingredients = [];
            $total = 0;

            // Functions
            foreach (['flavour','extraTopping', 'cone'] as $name) {
                $choice = $_GET[$name];
                if (isset($_GET[$name]) ) {
                    $names = $name . 's';
                    if (is_array($choice)) {
                        foreach ($choice as $value) {
                            if( isset($$names[$value])) { // Dynamic variables with double $
                                $ingredients[] = $value;
                                $total += $$names[$value];
                            }
                        } 
                    } else {
                        if( isset($$names[$choice]) ) {
                            $ingredients[] = $choice;
                            $total += $$names[$choice];
                        }
                    }
                }
            }
            function checkbox( string $name, string $value, array $data ): string 
            {
                $checked = '';
                if (isset($data[$name]) && in_array($value, $data[$name])) {
                    $checked .= 'checked';
                }
                return <<<HTML
                <input type="checkbox" name="{$name}[]" value="$value" $checked>
            HTML;
            }
            function radio( string $name, string $value, array $data ): string 
            {
                $checked = '';
                if (isset($data[$name]) && $value === $data[$name]) {
                    $checked .= 'checked';
                }
                return <<<HTML
                <input type="radio" name="{$name}" value="$value" $checked>
            HTML;
            }

            ?>

            <!-- Form -->
            <h2>Your ice cream:</h2>
            <h4>Ingredients:</h4>
            <ul>
                <?php foreach ($ingredients as $ingredient) {
                    echo '<li>' . $ingredient . '</li>';
                } ?>
            </ul>
            <h4>Price: <?= $total ?>€</h3>

            <h2>Compose your ice cream:</h2>
            <form action='<?= $this_page ?>' method='GET'>
                <h3>Choose your Flavours</h3>
                <?php foreach ($flavours as $flavour => $price) : ?>
                    <div class="checkbox">
                        <label>
                            <?= checkbox('flavour', $flavour, $_GET) ?>
                            <?= $flavour ?> - <?= $price ?>€
                        </label>
                    </div>
                <?php endforeach; ?>
                <h3>Choose your Cone</h3>
                <?php foreach ($cones as $cone => $price) : ?>
                    <div class="radio">
                        <label>
                            <?= radio('cone', $cone, $_GET) ?>
                            <?= $cone ?> - <?= $price ?>€
                        </label>
                    </div>
                <?php endforeach; ?>
                <h3>Choose your Extra toppings</h3>
                <?php foreach ($extraToppings as $extraTopping => $price) : ?>
                    <div class="checkbox">
                        <label>
                            <?= checkbox('extraTopping', $extraTopping, $_GET) ?>
                            <?= $extraTopping ?> - <?= $price ?>€
                        </label>
                    </div>
                <?php endforeach; ?>
                <div class="form-btn">
                    <button type='submit'>Validate my choice</button>
                </div><?php
        resultout();

    instruction('Code:');

        codein(null); ?>
// Checkbox
$flavours = [
    'Strawberry' => 4,
    'Chocolate' => 5,
    'Vanilla' => 3
];

// Radio
$cones = [
    'Bucket' => 2,
    'Cone' => 3
];

// Checkbox
$extraToppings = [
    'Chocolate chip' => 1,
    'Whiped cream' => 0.5
];


// Variables
$this_page = $_SERVER["REQUEST_URI"];
$checked = null;
$ingredients = [];
$total = 0;

// Functions
foreach (['flavour','extraTopping', 'cone'] as $name) {
    $choice = $_GET[$name];
    if (isset($_GET[$name]) ) {
        $names = $name . 's';
        if (is_array($choice)) {
            foreach ($choice as $value) {
                <b>if( isset($$names[$value]))</b> { <l>// Dynamic variables with double $</l>
                    $ingredients[] = $value;
                    $total += $$names[$value];
                }
            } 
        } else {
            if( isset($$names[$choice]) ) {
                $ingredients[] = $choice;
                $total += $$names[$choice];
            }
        }
    }
}
function checkbox( string $name, string $value, array $data ): string 
{
    $checked = '';
    if (isset($data[$name]) && in_array($value, $data[$name])) {
        $checked .= 'checked';
    }
    return &lt&lt&ltHTML
    &ltinput type="checkbox" name="{$name}[]" value="$value" $checked>
HTML;
}
function radio( string $name, string $value, array $data ): string 
{
    $checked = '';
    if (isset($data[$name]) && $value === $data[$name]) {
        $checked .= 'checked';
    }
    return &lt&lt&ltHTML
    &ltinput type="radio" name="{$name}" value="$value" $checked>
HTML;
}

?>

&lt!-- Form -->
&lth2>Your ice cream:&lt/h2>
&lth4>Ingredients:&lt/h4>
&ltul>
    &lt?php foreach ($ingredients as $ingredient) {
        echo '&ltli>' . $ingredient . '&lt/li>';
    } ?>
&lt/ul>
&lth4>Price: &lt?= $total ?>€&lt/h3>

&lth2>Compose your ice cream:&lt/h2>
&ltform action='&lt?= $this_page ?>' method='GET'>
    &lth3>Choose your Flavours&lt/h3>
    &lt?php foreach ($flavours as $flavour => $price) : ?>
        &ltdiv class="checkbox">
            &ltlabel>
                &lt?= checkbox('flavour', $flavour, $_GET) ?>
                &lt?= $flavour ?> - &lt?= $price ?>€
            &lt/label>
        &lt/div>
    &lt?php endforeach; ?>
    &lth3>Choose your Cone&lt/h3>
    &lt?php foreach ($cones as $cone => $price) : ?>
        &ltdiv class="radio">
            &ltlabel>
                &lt?= radio('cone', $cone, $_GET) ?>
                &lt?= $cone ?> - &lt?= $price ?>€
            &lt/label>
        &lt/div>
    &lt?php endforeach; ?>
    &lth3>Choose your Extra toppings&lt/h3>
    &lt?php foreach ($extraToppings as $extraTopping => $price) : ?>
        &ltdiv class="checkbox">
            &ltlabel>
                &lt?= checkbox('extraTopping', $extraTopping, $_GET) ?>
                &lt?= $extraTopping ?> - &lt?= $price ?>€
            &lt/label>
        &lt/div>
    &lt?php endforeach; ?>
    &ltdiv class="form-btn">
        &ltbutton type='submit'>Validate my choice&lt/button>
    &lt/div>&lt?php<?php codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

?>