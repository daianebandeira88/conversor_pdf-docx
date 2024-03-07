<?php
require_once 'C:/xampp/htdocs/projeto_teste/projetos/vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi;

// Inclua a classe TCPDF manualmente
require_once 'C:\xampp\htdocs\projeto_teste\projetos\vendor\tecnickcom\tcpdf/tcpdf.php';

// Função para extrair texto de um arquivo PDF
function extract_text_from_pdf($pdf_path, $docx_file) {
    // Instancie a classe FPDI com TCPDF
    $pdf = new Fpdi();

    // Adicione uma nova página
    $pdf->AddPage();

    // Defina o arquivo PDF como fonte
    $pdf->setSourceFile($pdf_path);

    // Loop através de cada página do PDF
    for ($i = 1; $i <= $pdf->getNumPages(); $i++) {
        // Adicione a página atual ao PDF
        $pdf->useTemplate($pdf->importPage($i));
    }

    // Salve o PDF convertido para o arquivo DOCX
    if (!$pdf->Output($docx_file, 'F')) {
        echo "Erro ao salvar o arquivo DOCX.";
        var_dump(error_get_last()); // Mostra o último erro ocorrido
        exit; // Encerra o script
    }
}

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Restante do código para processar o formulário...
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            overflow-y: hidden;
        }
    </style>
    <title>Conversor</title>
</head>

<body class="relative bg-gray-600">
<header id="header" class="mt-0 w-full bg-white bg-opacity-90 h-20 color-black text-center flex justify-center items-center" style="z-index:9;font-family: 'Cambay', sans-serif;">
    <div class="ml-0 mt-4">
        <h2 class="text-3xl">Converter PDF para DOCX</h2>
    </div>
</header>

    <div class="container flex items-center justify-center  ml-20 mt-20">
        <form method="post" enctype="multipart/form-data" class="bg-gray-100 p-6 rounded-lg shadow-lg p-40">
            <label for="pdf_file">Selecione o arquivo PDF:</label><br>
            <input type="file" id="pdf_file" name="pdf_file" required class="mt-2 "><br><br>
            <label for="docx_name">Nome do arquivo DOCX:</label><br>
            <input type="text" id="docx_name" name="docx_name" required class="mt-2 border border-gray-400 rounded-md"><br><br>
            <label for="output_folder">Pasta de destino:</label><br>
            <input type="text" id="output_folder" name="output_folder" required class="mt-2 border border-gray-400 rounded-md"><br><br>
            <input type="submit" value="Converter PDF para DOCX" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>

    <script>
    </script>

</body>

</html>
