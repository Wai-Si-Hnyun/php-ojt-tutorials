<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory as ExcelIOFactory;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
/**
 * Read text file
 *
 * @return string $txtFile
 */
function readTxtFile() {
    $txtFile = file_get_contents('files/sample.txt');
    return nl2br($txtFile);
}

/**
 * Read document file
 *
 * @return string $text
 */
function readDocFile() {
    $filename = "files/sample.doc";
    $objReader = WordIOFactory::createReader('MsDoc');
    $phpWord = $objReader->load("$filename");

    $sections = $phpWord->getSections();
    $text = "";
    foreach ($sections as $section) {
        $elements = $section->getElements();

        foreach ($elements as $element) {
            if ($element instanceof Text) {
                $text .= $element->getText();
                $text .= "<br>";
            }
        }
    }
    return $text;
}

/**
 * Read csv file
 *
 * @return mixed $html
 */
function handleCsvFile() {
    $csvFile = "files/sample.csv";

    if (($fileHandle = fopen($csvFile, 'r')) !== false) {

        $html = "<table class='table'>";

        // Loop through each row in the CSV file
        $isFirstRow = true;
        while (($data = fgetcsv($fileHandle)) !== false) {

            if ($isFirstRow == true) {
                $html .= "<thead><tr>";
            } else {
                $html .= "<tr>";
            }

            foreach ($data as $item) {
                //Split the string by all whitespace
                $cells = preg_split('/\s+/', $item);

                //Check the index of name is splited or not
                if (count($cells) > 6) {
                    $newVal = implode(' ', array($cells[1], $cells[2]));
                    array_splice($cells, 2, 1);
                    $cells[1] = $newVal;
                }

                foreach ($cells as $cell) {
                    if ($isFirstRow == true) {
                        $html .= "<th>$cell</th>";
                    } else {
                        $html .= "<td>$cell</td>";
                    }
                }
            }

            if ($isFirstRow == true) {
                $html .= "</tr></thead><tbody>";
            } else {
                $html .= "</tr>";
            }

            $isFirstRow = false;

        }

        // Close the tbody tag and the table tag
        $html .= "</tbody></table>";

        //Close the file
        fclose($fileHandle);

        // Output the HTML table
        return $html;
    }

}

/**
 * Read Excel File
 *
 * @return object $sheet
 */
function readExcelFile() {
    $inputFile = "files/sample.xlsx";

    $phpExcel = ExcelIOFactory::load("$inputFile");
    $sheet = $phpExcel->getActiveSheet();
    return $sheet;
}

/**
 * Build html table for excel sheet
 *
 * @param object $sheet
 * @return string $html
 */
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
</head>
<body>
  <div class="container p-5 border my-5">
    <div class="txt-file mb-5">
      <h2>Text File</h2>
      <hr>
      <p><?php echo readTxtFile(); ?></p>
    </div>
    <div class="doc-file mb-5">
      <h2>Doc File</h2>
      <hr>
      <p><?php echo readDocFile(); ?></p>
    </div>
    <div class="csv-file mb-5">
      <h2>CSV File</h2>
      <hr>
      <?php echo handleCsvFile(); ?>
    </div>
    <div class="excel-file mb-5">
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