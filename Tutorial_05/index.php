<?php
  require 'vendor/autoload.php';
  //Read text file
  $txtFile = file_get_contents('files/sample.txt');

  //Read doc file
  function readDocFile() {
    //Original file
    $originalFile = './files/sample.doc';

    //Convert doc file to html
    $htmlFile = './files/sample.html';

    //Convert doc file to html
    exec("unoconv -f html -o $htmlFile $originalFile");

    $html = file_get_contents($htmlFile);
    $text = preg_replace('/<head>.*<\/head>/s', '', $html);
    $text = nl2br($text);
    $text = strip_tags($text);

    return $text;
  }

  function readExcelFile() {
    $inputFile = "files/sample.xlsx";

    $phpExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load("$inputFile");
    $sheet = $phpExcel->getActiveSheet();
    return $sheet;
  }

  function readCsvFile() {
    $csvFile = "files/sample.csv";
    $fileHandle = fopen($csvFile, 'r');
    $data = fgetcsv($fileHandle, 1000, ',');
    print_r($data);
    fclose($fileHandle);
    // while ($data !== false) {
    //   foreach($data as $value) {
    //     echo $value . " ";
    //   }
    // }
    
  }

  function excelToHtmlTable($sheet) {
    // Initialize the HTML table
    $html = "<table class='table'>";

    // Loop through each row
    foreach ($sheet->getRowIterator() as $row) {
        // If it's the first row, add it to the thead tag
        if ($row->getRowIndex() == 1) {
            $html .= "<thead><tr>";
        } else {
            $html .= "<tr>";
        }

        // Loop through each cell in the row
        foreach ($row->getCellIterator() as $cell) {
            // Get the value of the cell
            $value = $cell->getValue();

            // If it's the first row, add it to the thead tag
            if ($row->getRowIndex() == 1) {
                $html .= "<th>$value</th>";
            } else {
                $html .= "<td>$value</td>";
            }
        }

        // If it's the first row, close the thead tag
        // Otherwise, close the tbody row
        if ($row->getRowIndex() == 1) {
            $html .= "</tr></thead><tbody>";
        } else {
            $html .= "</tr>";
        }
    }

    // Close the tbody tag and the table tag
    $html .= "</tbody></table>";

    // Output the HTML table
    return $html;

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Read Demo</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="libs/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <div class="txt-file">
      <h2>Text File</h2>
      <hr>
      <p><?php echo nl2br($txtFile) ?></p>
    </div>
    <div class="doc-file">
      <h2>Doc File</h2>
      <hr>
      <p><?php echo "Hello" ?></p>
    </div>
    <div class="csv-file">
      <h2>CSV File</h2>
      <hr>
      <p><?php readCsvFile(); ?></p>
    </div>
    <div class="excel-file">
      <h2>Excel File</h2>
      <hr>
      <?php 
        $sheet = readExcelFile();
        echo excelToHtmlTable($sheet);
      ?>
    </div>
  </div>
  </div>
</body>
</html>