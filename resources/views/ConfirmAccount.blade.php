<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghost Skate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <style>
        .creepster-regular {
            font-family: "Creepster", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .title {
            font-size: 25px;
        }

        body {
            padding: 0;
            margin: 0;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: center;
            border-bottom: 1px solid gray;
        }

        .image-logo {
            width: 180px;
        }

        .content {
            text-align: center;
            padding-left: 4svw;
            padding-right: 4svw;
        }

        .terms {
            color: black;
        }

        .terms:hover {
            color: blue;
        }

        .content-button-confirm {
            margin-top: 4svh;
        }

        .button-confirm {
            background-color: black;
            color: white;
            width: 70%;
            border-radius: 5px;
            padding: 5px;
            cursor: pointer;
            border: 0.5px solid transparent;
        }

        .button-confirm:hover {
            color: black;
            background-color: white;
            border: 0.5px solid black;
        }

        .text-info {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="content">
        <h4 class="creepster-regular title">CONFIRMAR CONTA</h4>
        <p>
            A GhostFlip agradece o seu interesse em fazer parte de nossa comunidade, ao confirmar seu cadastro neste e-mail você estará de acordo com os
            <a class="terms creepster-regular" href="https://ghostflip.com.br/info">termos e condições</a> de uso da plataforma.
        </p>
        <div class="content-button-confirm">
            <a href="<?php echo $data['url'] . '/' . $data['id'] . '/' . $data['email'] . '/' . $data['token'] ?>">
                <button class="button-confirm creepster-regular">Confirmar</button>
            </a>
        </div>
        <p class="text-info">
            Se não se cadastrou em nossa plataforma, por favor, ignore este e-mail.
        </p>
    </div>
</body>

</html>