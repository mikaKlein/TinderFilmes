<?php
include_once 'ActiveRecord.php'; 
include_once 'MySQL.php'; 

class Usuario implements ActiveRecord {

    private int $idUser;
    private int $isGerente;

    public function __construct(private string $emailInstitucional, private string $senha, private string $nome) {
    }

    public function setIdUser(int $idUser): void {
        $this->idUser = $idUser;
    }

    public function getIdUser(): int {
        return $this->idUser;
    }

    public function setEmailInstitucional(string $emailInstitucional): void {
        $this->emailInstitucional = $emailInstitucional;
    }

    public function getEmailInstitucional(): string {
        return $this->emailInstitucional;
    }

    public function setSenha(string $senha): void {
        $this->senha = $senha;
    }

    public function getSenha(): string {
        return $this->senha;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setIsGerente(int $isGerente): void {
        $this->isGerente = $isGerente;
    }

    public function getIsGerente(): int {
        return $this->isGerente;
    }

    public function save(): bool {
        $conexao = new MySQL();
        if (isset($this->idUser)) {
            $this->senha = password_hash($this->senha);
            $sql = "UPDATE usuario SET senha = '{$this->senha}', emailInstitucional = '{$this->emailInstitucional}', nome = '{$this->nome}' WHERE idUser = {$this->idUser}";
        } else {
            $sql = "INSERT INTO usuario (senha, emailInstitucional, nome) VALUES ('{$this->senha}', '{$this->emailInstitucional}', '{$this->nome}')";
        }
        return $conexao->executa($sql);
    }

    public function delete(): bool {
        $conexao = new MySQL();
        $sql = "DELETE FROM usuario WHERE idUser = {$this->idUser}";
        return $conexao->executa($sql);
    }

    public static function find($idUser): Usuario {
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE idUser = {$idUser}";
        $resultado = $conexao->consulta($sql);

        $senha = $resultado[0]["senha"];
        $u = new Usuario($resultado[0]['emailInstitucional'], $senha, $resultado[0]['nome']);
        $u->setIdUser($resultado[0]['idUser']);
        $u->setIsGerente($resultado[0]['isGerente']);
        return $u;
    }

    public static function findall(): array {
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario";
        $resultados = $conexao->consulta($sql);

        $users = [];
        foreach ($resultados as $resultado) {
            $senha = $resultado["senha"];
            $u = new Usuario($resultado['emailInstitucional'], $senha, $resultado['nome']);
            $u->setIdUser($resultado['idUser']);
            $u->setIsGerente($resultado[0]['isGerente']);
            $users[] = $r;
        }
        return $users;
    }    

    public static function findByEmail($email): ?Usuario {
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE emailInstitucional = '{$email}'";
        $resultado = $conexao->consulta($sql);
        
        if(isset($resultado[0])){
            $senha = $resultado[0]["senha"];
            $u = new Usuario($resultado[0]['emailInstitucional'], $senha, $resultado[0]['nome']);
            $u->setIdUser($resultado[0]['idUser']);
            $u->setIsGerente($resultado[0]['isGerente']);
            return $u;
        }
    
        return null;
    }
}
?>