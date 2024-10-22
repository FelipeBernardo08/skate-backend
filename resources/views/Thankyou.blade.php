<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <title>GHOSTFLIP</title>
    <style>
        .creepster-regular {
            font-family: "Creepster", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        header {
            display: flex;
            justify-content: center;
            border-bottom: 1px solid gray;
        }

        .image-logo {
            width: 180px;
            border-radius: 100%;
        }

        .content {
            text-align: center;
            padding-left: 4svw;
            padding-right: 4svw;
        }

        .btn-redirect {
            cursor: pointer;
            border: 1px solid transparent;
            background-color: black;
            color: white;
            padding: 10px;
            width: 70%;
            margin-top: 3svh;
            border-radius: 5px;
        }

        .btn-redirect-hover {
            border: 1px solid black;
            color: black;
            background-color: white;
            animation: animation-button;
            animation-duration: 2s;
            animation-fill-mode: both;
        }

        .btn-redirect-leave {
            animation: animation-button-leave;
            animation-duration: 2s;
            animation-fill-mode: both;
        }

        @keyframes animation-button {
            from {
                width: 70%;
            }

            to {
                width: 90%;
            }
        }

        @keyframes animation-button-leave {
            from {
                width: 90%;
            }

            to {
                width: 70%;
            }
        }
    </style>
</head>

<body>
    <header>
        <img src="http://localhost:4200/assets/3ohze2IqF09aevkCVa.webp" class="image-logo" alt="">
    </header>

    <div class="content">
        <h2 class="creepster-regular">
            Obrigado!
        </h2>
        <p>
            A <span class="creepster-regular">GhostFlip</span> agradece seu interesse em fazer parte de nossa história, seu cadastro foi ativado com sucesso!
        </p>
        <p>
            Clique no botão a baixo para ser redirecionado para nossa plataforma.
        </p>
        <a href="https://ghostflip.com.br">
            <button id="button-redirect" onmouseover="insertClass()" onmouseleave="removeClass()" class="btn-redirect creepster-regular">
                Ir para GhostFlip
            </button>
        </a>
    </div>

    <script>
        function insertClass() {
            let button = document.getElementById('button-redirect');
            button.classList.remove('btn-redirect-leave')
            button.classList.add('btn-redirect-hover')
        }

        function removeClass() {
            let button = document.getElementById('button-redirect');
            button.classList.remove('btn-redirect-hover')
            button.classList.add('btn-redirect-leave')
        }
    </script>
</body>

</html>