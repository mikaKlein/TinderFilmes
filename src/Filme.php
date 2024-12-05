<?php
include_once 'ActiveRecord.php';
include_once 'MySQL.php';

class Filme implements ActiveRecord {

    private int $idFilme;

    public function __construct(
        private string $caminhoFoto, 
        private string $descricao, 
        private string $nome, 
        private int $anoLancamento, 
        private string $diretor, 
        private string $genero, 
        private int $duracao
    ) {}

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

    public function setAnoLancamento(int $anoLancamento): void {
        $this->anoLancamento = $anoLancamento;
    }

    public function getAnoLancamento(): int {
        return $this->anoLancamento;
    }

    public function setDiretor(string $diretor): void {
        $this->diretor = $diretor;
    }

    public function getDiretor(): string {
        return $this->diretor;
    }

    public function setGenero(string $genero): void {
        $this->genero = $genero;
    }

    public function getGenero(): string {
        return $this->genero;
    }

    public function setDuracao(int $duracao): void {
        $this->duracao = $duracao;
    }

    public function getDuracao(): int {
        return $this->duracao;
    }

    public function save(): bool {
        $conexao = new MySQL();
        if (isset($this->idFilme)) {
            $sql = "
                UPDATE filme 
                SET 
                    descricao = '{$this->descricao}', 
                    caminhoFoto = '{$this->caminhoFoto}', 
                    nome = '{$this->nome}', 
                    anoLancamento = {$this->anoLancamento}, 
                    diretor = '{$this->diretor}', 
                    genero = '{$this->genero}', 
                    duracao = {$this->duracao} 
                WHERE idFilme = {$this->idFilme}
            ";
        } else {
            $sql = "
                INSERT INTO filme (descricao, caminhoFoto, nome, anoLancamento, diretor, genero, duracao) 
                VALUES (
                    '{$this->descricao}', 
                    '{$this->caminhoFoto}', 
                    '{$this->nome}', 
                    {$this->anoLancamento}, 
                    '{$this->diretor}', 
                    '{$this->genero}', 
                    {$this->duracao}
                )
            ";
        }
        return $conexao->executa($sql);
    }

    public function delete(): bool {
        $conexao = new MySQL();
        $sql = "DELETE FROM voto WHERE idFilme = {$this->idFilme}";
        $conexao->executa($sql);

        $sql = "DELETE FROM filme WHERE idFilme = {$this->idFilme}";
        return $conexao->executa($sql);
    }

    public static function find($idFilme): Filme {
        $conexao = new MySQL();
        $sql = "SELECT * FROM filme WHERE idFilme = {$idFilme}";
        $resultado = $conexao->consulta($sql);

        $f = new Filme(
            $resultado[0]['caminhoFoto'], 
            $resultado[0]['descricao'], 
            $resultado[0]['nome'], 
            $resultado[0]['anoLancamento'], 
            $resultado[0]['diretor'], 
            $resultado[0]['genero'], 
            $resultado[0]['duracao']
        );
        $f->setIdFilme($resultado[0]['idFilme']);
        return $f;
    }

    public static function findAll(): array {
        $conexao = new MySQL();
        $sql = "SELECT * FROM filme";
        $resultados = $conexao->consulta($sql);

        $filmes = [];
        foreach ($resultados as $resultado) {
            $f = new Filme(
                $resultado['caminhoFoto'], 
                $resultado['descricao'], 
                $resultado['nome'], 
                $resultado['anoLancamento'], 
                $resultado['diretor'], 
                $resultado['genero'], 
                $resultado['duracao']
            );
            $f->setIdFilme($resultado['idFilme']);
            $filmes[] = $f;
        }
        return $filmes;
    }

    public static function findUnicFilme($userId): ?Filme {
        $conexao = new MySQL();
        $sql = "
            SELECT * FROM filme
            WHERE idFilme NOT IN (
                SELECT idFilme FROM voto WHERE idUser = {$userId}
            )
            LIMIT 1
        ";

        $resultado = $conexao->consulta($sql);

        if (isset($resultado[0])) {
            $f = new Filme(
                $resultado[0]['caminhoFoto'], 
                $resultado[0]['descricao'], 
                $resultado[0]['nome'], 
                $resultado[0]['anoLancamento'], 
                $resultado[0]['diretor'], 
                $resultado[0]['genero'], 
                $resultado[0]['duracao']
            );
            $f->setIdFilme($resultado[0]['idFilme']);
            return $f;
        }

        return null;
    }

    public static function findAllByStars($ordem): array {
        $conexao = new MySQL();
        $sql = "
            SELECT f.idFilme, f.caminhoFoto, f.descricao, f.nome, f.anoLancamento, f.diretor, f.genero, f.duracao, AVG(v.numStars) as media
            FROM filme f
            JOIN voto v ON f.idFilme = v.idFilme
            GROUP BY f.idFilme
            ORDER BY media {$ordem}
        ";

        $resultados = $conexao->consulta($sql);

        $filmes = [];
        foreach ($resultados as $resultado) {
            $f = new Filme(
                $resultado['caminhoFoto'], 
                $resultado['descricao'], 
                $resultado['nome'], 
                $resultado['anoLancamento'], 
                $resultado['diretor'], 
                $resultado['genero'], 
                $resultado['duracao']
            );
            $f->setIdFilme($resultado['idFilme']);
            $filmes[] = $f;
        }
        return $filmes;
    }

    public function getMediaVotos(): float {
        $conexao = new MySQL();
        $sql = "SELECT AVG(numStars) as media FROM voto WHERE idFilme = {$this->idFilme}";
        $resultado = $conexao->consulta($sql);
        return $resultado[0]['media'];
    }

    public function getQuantidadeVotos(): int {
        $conexao = new MySQL();
        $sql = "SELECT COUNT(*) as quantidade FROM voto WHERE idFilme = {$this->idFilme}";
        $resultado = $conexao->consulta($sql);
        return $resultado[0]['quantidade'];
    }
}