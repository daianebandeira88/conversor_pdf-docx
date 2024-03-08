<?php
require_once 'C:/xampp/htdocs/projeto_teste/projetos/vendor/autoload.php';
use Spatie\PdfToText\Pdf;

// Função para extrair texto de um arquivo PDF
function extract_text_from_pdf($pdf_path) {
    // Use a biblioteca Spatie PdfToText para extrair texto do PDF
    $text = (new Pdf())
        ->setPdf($pdf_path)
        ->text();

    return $text;
}

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o arquivo PDF foi enviado
    if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        // Caminho temporário do arquivo PDF
        $tmp_pdf_path = $_FILES['pdf_file']['tmp_name'];

        // Nome do arquivo DOCX especificado pelo usuário
        $docx_name = $_POST['docx_name'];

        // Pasta de destino especificada pelo usuário
        $output_folder = 'C:\Users\Taina\Desktop\recebe';

       // Caminho completo para o arquivo DOCX de saída
        $docx_file = $output_folder . DIRECTORY_SEPARATOR . $docx_name . '.docx';

        // Extrair texto do PDF
        $text = extract_text_from_pdf($tmp_pdf_path);

        // Salvar o texto extraído em um arquivo DOCX
        file_put_contents($docx_file, $text);

        // Redirecione para o arquivo DOCX gerado
        header('Location: ' . $docx_file);
        exit;
    } else {
        echo "Erro: Nenhum arquivo PDF enviado.";
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Conversor</title>
</head>

<body class="relative bg-gray-600">
    <header id="header" class="mt-0 w-full bg-white bg-opacity-90 h-20 color-black text-center flex justify-center items-center" style="z-index:9;font-family: 'Cambay', sans-serif;">
        <div class="ml-0 mt-4">
            <h2 class="text-3xl">Converter PDF para DOCX</h2>
        </div>
    </header>

    <div class="container flex items-center justify-center ml-20 mt-20">
        <form id="pdfForm" method="post" enctype="multipart/form-data" class="bg-gray-100 p-6 rounded-lg shadow-lg p-40">
            <label for="pdf_file">Selecione o arquivo PDF:</label><br>
            <input type="file" id="pdf_file" name="pdf_file" required class="mt-2 "><br><br>
            <label for="docx_name">Nome do arquivo DOCX:</label><br>
            <input type="text" id="docx_name" name="docx_name" required class="mt-2 border border-gray-400 rounded-md"><br><br>
            <button type="button" id="submitBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Converter PDF para DOCX</button>
        </form>
    </div> 

    <script>
        // Adiciona evento de clique ao botão para enviar o formulário
        document.getElementById("submitBtn").addEventListener("click", function() {
            document.getElementById("pdfForm").submit();
        });
    </script>

</body>

</html>
