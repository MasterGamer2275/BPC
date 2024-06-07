 <?php
function imageToText($imagePath) {
    // Path to Tesseract executable
    $tesseractPath = 'tesseract'; // Ensure this is in your PATH or provide the full path

    // Temporary file to store the output
    $outputFile = tempnam(sys_get_temp_dir(), 'ocr');

    // Command to run Tesseract
    $command = "$tesseractPath " . escapeshellarg($imagePath) . " " . escapeshellarg($outputFile) . " -l eng";

    // Execute the command
    exec($command);

    // Read the output text
    $text = file_get_contents($outputFile . '.txt');

    // Clean up temporary files
    unlink($outputFile);
    unlink($outputFile . '.txt');

    return $text;
}
// Example usage
$imagePath = 'tabimage.png'; // Replace with your image path
$text = imageToText($imagePath);
echo "<pre>$text</pre>";
?>