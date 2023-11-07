<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>    

    <title>Login</title>
    <style>
      html,
        body {
        height: 100%;
        }

        .form-signin {
        max-width: 330px;
        padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
        z-index: 2;
        }

        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>

</head>
<body>
    <main class="form-signin w-100 m-auto">
    <form id="loginForm">
        <img class="mb-4" src="https://static.corinthians.com.br/img/escudos/SCCP_escudo-150px.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    </form>
    </main>
    
    <script>

    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita o envio padrão do formulário

        // Obtém os valores dos campos de entrada
        var email = document.getElementById('floatingInput').value;
        var password = document.getElementById('floatingPassword').value;

        // Envia uma requisição POST para o endpoint da API Laravel
        fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ //payload
                email: email,
                password: password
            })
        })
        .then(response => response.json())
        .then(data => {
            // Manipula a resposta da API aqui
            Cookies.set('_myapp_token',data.access_token)
            console.log(data); // Exibe a resposta no console para fins de depuração
            // Redireciona o usuário ou executa outras ações com base na resposta da API
        })
        .catch(error => {
            console.error('Erro ao enviar a requisição:', error);
        });
    });
    </script>
</body>
</html>
