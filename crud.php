    <?php
    $db = new mysqli('localhost', 'root', '', 'mds');

    function getNomes() {
    global $db;
    $sql = "SELECT * FROM `mds`";
    $result = $db->query($sql);
    $nomes = [];
    while ($row = $result->fetch_assoc()) {
        $nomes[] = $row;
    }
    return $nomes;
}
function adicionarNome($nome) {
    global $db;
    $sql = "INSERT INTO mds (mds) VALUES ('$nome')";
    $db->query($sql);
}

function editarNome($id, $nome) {
    global $db;
    $sql = "UPDATE mds SET mds = '$nome' WHERE id = $id";
    $db->query($sql);
}

function excluirNome($id) {
    global $db;
    $sql = "DELETE FROM mds WHERE id = $id";
    $db->query($sql);
}

$acao = isset($_GET['acao']) ? $_GET['acao'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';

 if ($acao === 'editar') {
    $id = intval($_GET['id']);
    $nomeoriginal = ($_GET['nome']);
    $nome = $_POST['nome'];
    editarNome($id, $nome);
    header('Location: editar.php?id=' . $id . 'nome=' . $nomeoriginal); // Redirecionar para editar.php com o ID
    exit();
} elseif ($acao === 'excluir') {
    excluirNome($id);
    header('Location: crud.php');
    exit();
}
 $db->close(); ?>