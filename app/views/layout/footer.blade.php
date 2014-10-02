
<hr>
<?php $time_taken = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']; ?>
<h4 class="text-center">
Cream
</h4>
<p class="text-center">
    Página generada en {{ round($time_taken, 3) }} segundos</p>
</p>