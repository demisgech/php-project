<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        form {
            border: 1px solid #d703fd;
            border-radius: 10px;
            padding: 1rem;
            max-width: 300px;
        }

        input {
            display: block;
            outline: 0;
            border: 1px solid steelblue;
            border-radius: 10px;
            width: 100%;
            padding: 5px 3px;
            margin: 5px;
            cursor: pointer;
        }

        button {
            outline: 0;
            border: 0;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            background-color: #d703fd;
            transition: all .3s;
            cursor: pointer;
        }

        button:hover {
            background-color: dodgerblue;
        }
    </style>
    <title>Upload file</title>
</head>
<body>
<form action="FileUploadController.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" id="file">
    <button type="submit">Upload</button>
</form>
</body>
</html>