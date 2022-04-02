<?php 

$locations = [
    'paris_fr'         => [48.85, 2.35],
    'new-york_us'      => [40.71, -74.00],
    'kerikeri_nz'      => [-35.22, 173.94]
];

$title = 'Weather forecast';
require_once 'includes/header.php';
require_once 'class/OpenWeather.php';

$error = null;
$weather = new OpenWeather('4f34eb4cec4aa5200aa8b415963e297c');
try {
    foreach ($locations as $location => $coordinates) {
        $locations_current[$location] = $weather->getCurrent($coordinates);
        $locations_lastHours[$location] = $weather->getLastHours($coordinates); 
    }
} catch (Exception $e) {
    $message_line = $e->getMessage();
    if (!empty($message_line)) { 
        if ((substr($message_line, 0, 1) === '{' && substr($message_line, -1, 1))) {
            $message_array = json_decode($message_line, true); 
            $message = 'Code ' . $message_array['cod'] . ': ' . $message_array['message'];
        } else {
            $message = $e->getMessage();
        }
    } else {
        $message = 'no details';
    } 
    $error = "An error occured, please try again later.
        <div class='small'>$message</div>";
} ?>

<p class="lead mb-5">The list below has been made through the OpenWeather API. I links the API to this website thanks to the curl extension for PHP and following <a href="/lessons/20201127_php_Use%20an%20API%20with%20cURL/">this lesson</a>.</p>

<?php if($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else: ?> 
    <div class="row">
        <?php foreach ($locations_current as $location => $data): ?>
            <?php $title = OpenWeather::getName($location) ?>
            <div class="col-md-<?= count($locations) === 4 ? '3' : '4' ?> mb-5">
                <div class="card">
                    <div class="card-body text-center">
                        <h4><?= $title['city'] . ' <span class="small text-muted">(' . $title['country'] . ')</span>' ?></h4>
                        <div class="small text-muted"><?= $data['time']['all'] ?></div>
                        <img src="<?= $data['icon']; ?>"/>
                        <div><?= $data['description'] ?></div>
                        <div><b><?= $data['temp'] ?></b></div>
                    </div>
                </div>
                <div class="mt-3">
                    <ul class="list-unstyled">
                        <?php 
                        $lastHours = $locations_lastHours[$location];
                        for ($i = count($lastHours) - 1; $i >= count($lastHours) - 15; $i -= 2): ?>
                            <?php if (!empty($lastHours[$i])): ?>
                                <li class="small text-muted"><?= $lastHours[$i]['time']['hour'] . ' : <b>' . $lastHours[$i]['temp'] . '</b>  - ' . $lastHours[$i]['description'] ?></li>
                            <?php endif; ?>
                            <?php
                        endfor; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>