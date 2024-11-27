<?php
include_once 'ActiveRecord.php'; 
include_once 'MySQL.php';

class Filme implements ActiveRecord {

    private int $idFilme;

    public function __construct(private string $caminhoFoto, private string $descricao, private string $nome) {
    }

    public function setIdFilme(int $idFilme): void {
        $this->idFilme = $idFilme;
    }

    public function getIdFilme(): int {
        return $this->idFilme;
    }

    public function setCaminhoFoto(string $caminhoFoto): void {
        $this->caminhoFoto = $caminhoFoto;
    }

    public function getCaminhoFoto(): string {
        return $this->caminhoFoto;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function save(): bool {
        $conexao = new MySQL();
        if (isset($this->idFilme)) {
            $sql = "UPDATE filme SET descricao = '{$this->descricao}', caminhoFoto = '{$this->caminhoFoto}', nome = '{$this->nome}' WHERE idFilme = {$this->idFilme}";
        } else {
            $sql = "INSERT INTO filme (descricao, caminhoFoto, nome) VALUES ('{$this->descricao}', '{$this->caminhoFoto}', '{$this->nome}')";
        }
        return $conexao->executa($sql);
    }

    public function delete(): bool {
        $conexao = new MySQL();
        $sql = "DELETE FROM filme WHERE idFilme = {$this->idFilme}";
        return $conexao->executa($sql);
    }

    public static function find($idFilme): Filme {
        $conexao = new MySQL();
        $sql = "SELECT * FROM filme WHERE idFilme = {$idFilme}";
        $resultado = $conexao->consulta($sql);

        $f = new filme($resultado[0]['caminhoFoto'], $resultado[0]["descricao"], $resultado[0]['nome']);
        $f->setIdFilme($resultado[0]['idFilme']);
        return $f;
    }

    public static function findall(): array {
        $conexao = new MySQL();
        $sql = "SELECT * FROM filme";
        $resultados = $conexao->consulta($sql);

        $filmes = [];
        foreach ($resultados as $resultado) {
            $f = new Filme($resultado['caminhoFoto'], $resultado["descricao"], $resultado['nome']);
            $f->setIdFilme($resultado['idFilme']);
            $filmes[] = $f;
        }
        return $filmes;
    }    

    public static function findUnicFilme($userId): Filme{
        $conexao = new MySQL();
        $sql = "
                SELECT * FROM filme
                WHERE idFilme NOT IN (
                    SELECT idFilme FROM voto WHERE idUser = {$userId}
                )
                LIMIT 1
            ";
        $resultado = $conexao->consulta($sql);
        $f = new Filme($resultado[0]['caminhoFoto'], $resultado[0]['descricao'], $resultado[0]['nome']);
        $f->setIdFilme($resultado[0]['idFilme']);
        return $f;
    }

}
?>