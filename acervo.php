<?php
session_start();
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
  unset($_SESSION['emailUsuario']);
  unset($_SESSION['senha']);
  header('Location: login.php');
}
$logado = $_SESSION['emailUsuario'];
?>

<?php
// Conexão com o banco de dados
include_once('config.php');

// Filtrar livros por gênero, título e autor
$whereClauses = [];
$params = [];
$types = '';  // Tipo de cada parâmetro (usado em bind_param)

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? null;

    if (!empty($_GET['pesquisa'])) {
    $whereClauses[] = "(livro.titulo LIKE ? OR livro.nome_autor LIKE ?)";
    $params[] = "%" . $_GET['pesquisa'] . "%";
    $params[] = "%" . $_GET['pesquisa'] . "%";
    $types .= "ss"; // Dois parâmetros de tipo string
    
    } elseif ($action === 'filter') {
    if (!empty($_GET['genero'])) {
    foreach ($_GET['genero'] as $genero) {
        $whereClauses[] = "livro.genero LIKE ?";
        $params[] = '%' . $genero . '%';
        $types .= 's';
    }
}

}
}
    


// Monta a cláusula WHERE
$whereSql = '';
if (count($whereClauses) > 0) {
    $whereSql = ' WHERE ' . implode(' AND ', $whereClauses);
}

// Consulta SQL
$query = "SELECT * FROM livros livro $whereSql ORDER BY titulo ASC";
$stmt = $conexao->prepare($query);

// Verifica se a consulta foi preparada corretamente
if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conexao->error);
}

// Vincula os parâmetros
if (count($params) > 0) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Processa os resultados
$livros = [];
while ($livro = $result->fetch_assoc()) {
    $livros[] = $livro;
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Biblioteca</title>
    <link rel="shortcut icon" type="imagex/png" href="icone.ico">
    <style>
        #sair
        {
            background-color: red;
            color: white;
            border-radius: 10px;
        }
    </style>
    <script>
        // Função para capturar a tecla Enter e enviar o formulário
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            searchInput.addEventListener("keypress", function(event) {
                // Verifica se a tecla pressionada foi 'Enter' (código 13)
                if (event.key === "Enter") {
                    document.getElementById("searchForm").submit();
                }
            });
        });
    </script>
</head>
<body id="background">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Biblioteca</span>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="acervo.php">Acervo <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="comunidade.php">Comunidade <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="faq.php">Contato <span class="sr-only">(página atual)</span></a>
                </li>
            </ul>
            <a href="perfil.php" class="btn btn-secondary btn-lg active" id="perfil" role="button" aria-pressed="true">Perfil</a>
            <a href="sair.php" class="btn btn-secondary btn-lg active" id="sair" role="button" aria-pressed="true">Sair</a>
        </div>
    </nav>
    <div class="container" id="acervo">
    <!-- Filtro de Gêneros -->
    <form method="GET">
    <aside class="filtro">
        <div>
            <label for="generos">Gêneros:</label><br>
            <input type="checkbox" name="genero[]" value="Aventura" <?= isset($_GET['genero']) && in_array('Aventura', $_GET['genero']) ? 'checked' : '' ?>> Aventura<br>
            <input type="checkbox" name="genero[]" value="Biografia" <?= isset($_GET['genero']) && in_array('Biografia', $_GET['genero']) ? 'checked' : '' ?>> Biografia<br>
            <input type="checkbox" name="genero[]" value="Distopia" <?= isset($_GET['genero']) && in_array('Distopia', $_GET['genero']) ? 'checked' : '' ?>> Distopia<br>
            <input type="checkbox" name="genero[]" value="Doméstica" <?= isset($_GET['genero']) && in_array('Doméstica', $_GET['genero']) ? 'checked' : '' ?>> Doméstica<br>
            <input type="checkbox" name="genero[]" value="Fábula" <?= isset($_GET['genero']) && in_array('Fábula', $_GET['genero']) ? 'checked' : '' ?>> Fábula<br>
            <input type="checkbox" name="genero[]" value="Fantasia" <?= isset($_GET['genero']) && in_array('Fantasia', $_GET['genero']) ? 'checked' : '' ?>> Fantasia<br>
            <input type="checkbox" name="genero[]" value="Ficção cientifica" <?= isset($_GET['genero']) && in_array('Ficção cientifica', $_GET['genero']) ? 'checked' : '' ?>> Ficção cientifica<br>
            <input type="checkbox" name="genero[]" value="Infantil" <?= isset($_GET['genero']) && in_array('Infantil', $_GET['genero']) ? 'checked' : '' ?>> Infantil<br>
            <input type="checkbox" name="genero[]" value="Jurídica"" <?= isset($_GET['genero']) && in_array('Jurídica', $_GET['genero']) ? 'checked' : '' ?>> Jurídica<br>
            <input type="checkbox" name="genero[]" value="Mistério" <?= isset($_GET['genero']) && in_array('Mistério', $_GET['genero']) ? 'checked' : '' ?>> Mistério<br>
            <input type="checkbox" name="genero[]" value="Poesia" <?= isset($_GET['genero']) && in_array('Poesia', $_GET['genero']) ? 'checked' : '' ?>> Poesia<br>
            <input type="checkbox" name="genero[]" value="Policial" <?= isset($_GET['genero']) && in_array('Policial', $_GET['genero']) ? 'checked' : '' ?>> Policial<br>
            <input type="checkbox" name="genero[]" value="Política" <?= isset($_GET['genero']) && in_array('Política', $_GET['genero']) ? 'checked' : '' ?>> Política<br>
            <input type="checkbox" name="genero[]" value="Quadrinhos" <?= isset($_GET['genero']) && in_array('Quadrinhos', $_GET['genero']) ? 'checked' : '' ?>> Quadrinhos<br>
            <input type="checkbox" name="genero[]" value="Romance" <?= isset($_GET['genero']) && in_array('Romance', $_GET['genero']) ? 'checked' : '' ?>> Romance<br>
            <input type="checkbox" name="genero[]" value="Sátira" <?= isset($_GET['genero']) && in_array('Sátira', $_GET['genero']) ? 'checked' : '' ?>> Sátira<br>
            <input type="checkbox" name="genero[]" value="Sociologia" <?= isset($_GET['genero']) && in_array('Sociologia', $_GET['genero']) ? 'checked' : '' ?>> Sociologia<br>
            <input type="checkbox" name="genero[]" value="Suspense" <?= isset($_GET['genero']) && in_array('Suspense', $_GET['genero']) ? 'checked' : '' ?>> Suspense<br>
            <!-- Adicione mais gêneros conforme necessário -->
        </div>
        <button type="submit" name="action" value="filter">Aplicar Filtros</button>
        </aside>
    </form>

    
        <main class="conteudo">
            <form method="GET">
            <!-- Barra de Pesquisa -->
            <div class="pesquisa">
            <input type="text" name="pesquisa" placeholder="Pesquisar por título ou autor" value="<?= $_GET['pesquisa'] ?? '' ?>" onkeydown="if(event.key === 'Enter'){this.form.submit();}">
            <button type="submit" name="action" value="search">Pesquisar</button>
            </div>
            </form>

    <!-- Resultados -->
    <div class="cards" id="cards-acervo">
    
        <?php if ($livros): ?>
            <?php foreach ($livros as $livro): ?>
                <div class="card column-md-3" style="width: 18rem;" id="livro-acervo">
                    <img src="<?= $livro['capa'] ?>" alt="<?= $livro['titulo'] ?>" id="capa-livro">
                    <div class="card-body">
                        <h5 class="card-title"><?= $livro['titulo'] ?></h5>
                        <p class="card-text">Autor: <?= $livro['nome_autor'] ?></p>
                        <a href="<?= $livro['titulo'] ?>.php?id=<?= $livro['id_livro'] ?>" class="btn btn-primary">Ler</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum livro encontrado.</p>
        <?php endif; ?>
        
    </div>
        </main>
    </div>
</body>
</html>

<?php
$stmt->close();
$conexao->close();
?>
