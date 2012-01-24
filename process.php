<?php
// build url - encode posted data to reduce nasties
$url = 'http://www.google.com/ig/api?weather=,,,' . urlencode($_POST['url']);
$xml = @simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOCDATA); // get data
// google spits back tons of stuff (all stored in attributes) - picking out interesting bits to display
// (obviously the data should really be checked before displaying to avoid any security issues)
?>
<p>Here you go:</p>
<h2>Current Conditions</h2>
<p><?php $attributes = $xml->weather->current_conditions->condition->attributes(); echo $attributes['data'];?> <?php $attributes = $xml->weather->current_conditions->temp_f->attributes(); echo $attributes['data'];?> F</p>
<p><?php $attributes = $xml->weather->current_conditions->humidity->attributes(); echo $attributes['data'];?></p>
<p><?php $attributes = $xml->weather->current_conditions->wind_condition->attributes(); echo $attributes['data'];?></p>
<p><img src="http://www.google.com/<?php $attributes = $xml->weather->current_conditions->icon->attributes(); echo $attributes['data'];?>"></p>
<h2>Forecast</h2>
<table>
    <tr><th>Day</th><th>High</th><th>Low</th><th>Conditions</th><th></th></tr>
    <?php
    $forecast_array = $xml->weather->forecast_conditions;
    foreach($forecast_array AS $forecast) { ?>
        <tr><td><?php $attributes = $forecast->day_of_week->attributes(); echo $attributes['data']; ?></td>
            <td><?php $attributes = $forecast->low->attributes(); echo $attributes['data']; ?> F</td>
            <td><?php $attributes = $forecast->high->attributes(); echo $attributes['data']; ?> F</td>
            <td><?php $attributes = $forecast->condition->attributes(); echo $attributes['data']; ?></td>
            <td><img src="http://google.com/<?php $attributes = $forecast->icon->attributes(); echo $attributes['data']; ?>"></td></tr>
    <?php
    }
    ?>
</table>
<p><em>Data provided by Google.</em></h4>
<p><strong>Ok so this page looks ugly and could probably be done way better, but then it did take me less than an hour to demonstrate that with the power of HTML5 and modern mobile browsers you do not need dedicated apps a lot of the time.</strong></p>