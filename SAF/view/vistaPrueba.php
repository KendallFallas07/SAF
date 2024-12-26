<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de unidad</title>
</head>

<body>

    <header>
        <?php include_once './header.php'; ?>
    </header>

    <h1>CRUD TIPO UNIDAD</h1>

    <hr>
    <form action="upload.php" method="post" id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="file" id="file" required>
        <button type="submit">Subir</button>
    </form>
    <hr>
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            const fileInput = document.getElementById('file');
            const file = fileInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('file', file);

                fetch('../business/actionPrueba.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => console.log(result))
                .catch(error => alert('Error al subir la imagen: ' + error));
            }
        });
    </script>


    <script src="unitType.js"></script>
</body>

</html>