<?php

namespace Core\Domain\Shared;

final class Tools
{
    public static function dd()
    {
        array_map(function ($content) {
            $paths = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5);

            echo "<table border='1' width='100%' style='margin: 0 auto'>";
            echo "<thead><tr bgcolor='#99c'><th>File</th><th>Function</th><th>Line</th><th>Class</th><th>Type</th>";
            echo "</tr></thead><tbody>";

            for ((int)$idx = count($paths) - 1; $idx > 0; $idx--) {
                echo "<tr>";
                echo "<td>" . $paths[$idx]['file'] . "</td>";
                echo "<td>" . $paths[$idx]['function'] . "</td>";
                echo "<td>" . $paths[$idx]['line'] . "</td>";
                echo "<td>" . ($paths[$idx]['class'] ?? "--") . "</td>";
                echo "<td>" . ($paths[$idx]['type'] ?? "--") . "</td>";
            }
            echo "<tr align='center' bgcolor='#99c'><td colspan='5'><b>DATA DUMP</b></td></tr>";
            echo "<tr bgcolor='#ddd'><td colspan='5'><pre style='font-size: 16px;'>";
            echo print_r($content, true);
            echo "</pre></td></tr>";
            echo "</tbody><br/>";
        }, func_get_args());
    }
}
