<?php
include_once 'ActiveRecord.php'; 
include_once 'MySQL.php';

class Voto implements ActiveRecord {

    private int $idVoto;

    public function __construct(private int $idFilme, private int $idUser, private float $numStars) {
    }

    public function setIdVoto(int $idVoto): void {
        $this->idVoto = $idVoto;
    }

    public function getIdVoto(): int {
        return $this->idVoto;
    }

    public function setIdFilme(int $idFilme): void {
        $this->idFilme = $idFilme;
    }

    public function getIdFilme(): int {
        return $this->idFilme;
    }

    public function setIdUser(int $idUser): void {
        $this->idUser = $idUser;
    }

    public function getIdUser(): int {
        return $this->idUser;
    }

    public function setNumStars(float $numStars): void {
        $this->numStars = $numStars;
    }

    public function getNumStars(): float {
        return $this->numStars;
    }

    public function save(): bool {
        $conexao = new MySQL();
        if (isset($this->idVoto)) {
            $sql = "UPDATE voto SET idUser = '{$this->idUser}', idFilme = '{$this->idFilme}', numStars = '{$this->numStars}' WHERE idVoto = {$this->idVoto}";
        } else {
            $sql = "INSERT INTO voto (idUser, idFilme, numStars) VALUES ('{$this->idUser}', '{$this->idFilme}', '{$this->numStars}')";
        }
        return $conexao->executa($sql);
    }

    public function delete(): bool {
        $conexao = new MySQL();
        $sql = "DELETE FROM voto WHERE idVoto = {$this->idVoto}";
        return $conexao->executa($sql);
    }

    public static function find($idVoto): Voto {
        $conexao = new MySQL();
        $sql = "SELECT * FROM voto WHERE idVoto = {$idVoto}";
        $resultado = $conexao->consulta($sql);

        $f = new Voto($resultado[0]['idFilme'], $resultado[0]["idUser"], $resultado[0]['numStars']);
        $f->setIdVoto($resultado[0]['idVoto']);
        return $f;
    }

    public static function findall(): array {
        $conexao = new MySQL();
        $sql = "SELECT * FROM voto";
        $resultados = $conexao->consulta($sql);

        $votos = [];
        foreach ($resultados as $resultado) {
            $v = new Voto($resultado['idFilme'], $resultado["idUser"], $resultado['numStars']);
            $v->setIdVoto($resultado['idVoto']);
            $votos[] = $v;
        }
        return $votos;
    }    
}
?>