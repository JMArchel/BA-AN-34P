<?php
 $input = 'masterlist2020.csv';
 $output = 'Masterlist2020 (2).csv';

 if (false !== ($ih = fopen($input, 'r'))) {
$oh = fopen($output, 'w');

while (false !== ($data = fgetcsv($ih))) {
    $outputData = array($data[0], $data[1], $data[2], $data[7], $data[9], $data[10], $data[11], $data[13], $data[14], $data[41], $data[42], $data[43], $data[47]);
    fputcsv($oh, $outputData);

}

$lines = file("Masterlist2020 (2).csv", FILE_SKIP_EMPTY_LINES );
$num_rows = count($lines);
foreach ($lines as $lineNo => $line) {
    $csv = str_getcsv($line);
    if (empty($csv[0] && $csv[1] && $csv[2] && $csv[3] && $csv[4] && $csv[5] && $csv[6] && $csv[7] && $csv[8] && $csv[9] && $csv[10] && $csv[11] && $csv[12])) {
        unset($lines[$lineNo]);
    }
}
file_put_contents("Masterlist2020 (3).csv", $lines);
 }
 echo "Success!";
?>
