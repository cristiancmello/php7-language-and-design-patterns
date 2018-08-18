<?php

// Cookie : é um mecanismo de armazenamento de dados no navegador, rastreando
// ou identificando o retorno de usuários.
setcookie('mycookie[foo]', 'cookie1', time()+3600); // definição de cookie deve ser feita antes de qualquer saída ao navegador

if ($_POST) {
    echo $_POST['username']."<br/>";
    echo $_REQUEST['username'];
}

echo $_COOKIE["mycookie"]["foo"]; // imprime 'test1' após submissão do form

if (isset($_COOKIE['count'])) {
    $count = $_COOKIE['count'] + 1;
} else {
    $count = 1;
}

setcookie('count', $count, time()+3600);
setcookie("Cart[$count]", $item, time()+3600);

?>

<html>
<head>
    <title>Forms example</title>
</head>

<body>
    <h1>Forms example</h1>

    <form action="/" method="post">
        Name: <input type="text" name="username"/><br/>
        Email: <input type="text" name="email"/><br/>
        <input type="submit" name="submit" value="Submit me!"/>
    </form>
</body>

</html>
