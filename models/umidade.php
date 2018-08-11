<?php
class Umidade {
	private $id;
	private $umidade;
	private $tempo;

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function getUmidade() {
		return $this->umidade;
	}

	public function setUmidade($umidade) {
		$this->umidade = $umidade;
	}

	public function getTempo() {
		return $this->tempo;
	}

	public function setTempo($tempo) {
		$this->tempo = $tempo;
	}

	/**
	 * retrieveAll
	 * ?controller=umidade&action=retrieveAll
	 */
	public static function retrieveAll() {
		$pdo = Db::getInstance();
		$stmt = $pdo->query('SELECT * FROM umidade');
		$dados = [];

		while ($row = $stmt->fetch()) {
			$dados[] = [
				'id' => $row['id'],
				'umidade' => $row['umidade'],
				'tempo' => $row['tempo']
			];
		}

		return $dados;
	}

	/**
	 * retrieve
	 * ?controller=umidade&action=retrieve&id=1
	 */
	public static function retrieve($id) {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM umidade WHERE id = :id LIMIT 1';
		$row = ['id' => $id];

		$stmt = $pdo->prepare($sql);
		$stmt->execute($row);

		$resultado = $stmt->fetch();

		if(!$resultado) return false;

		return [
			'id' => $resultado['id'],
			'umidade' => $resultado['umidade'],
			'tempo' => $resultado['tempo']
		];
	}

	/**
	 * create
	 * ?controller=umidade&action=create&umidade=5
	 */
	public function create() {
		$this->umidade = floatval($this->umidade);
		if($this->umidade == 0) return false;

		$pdo = Db::getInstance();
		$sql = 'INSERT INTO umidade SET umidade=:umidade, tempo=:tempo;';
		$row = [
			'umidade' => $this->umidade,
			'tempo' => $this->tempo
		];

		$status = $pdo->prepare($sql)->execute($row);

		if ($status) return $pdo->lastInsertId();

		return false;
	}

	/**
	 * update
	 * ?controller=umidade&action=update&id=1&umidade=4
	 */
	public function update() {
		if(!$this->retrieve($this->getId())) return false;
		$this->setUmidade(floatval($this->getUmidade()));
		if(!$this->getUmidade()) return false;

		$pdo = Db::getInstance();
		$sql = 'UPDATE umidade SET umidade=:umidade, tempo=:tempo WHERE id=:id;';
		$row = [
			'id' => $this->getId(),
			'umidade' => $this->getUmidade(),
			'tempo' => $this->getTempo()
		];

		return $pdo->prepare($sql)->execute($row);
	}

	/**
	 * delete
	 * ?controller=umidade&action=delete&id=7
	 */
	public static function delete($id) {
		if(!Umidade::retrieve($id)) return false;
		$pdo = Db::getInstance();
		$row = ['id' => $id];
		return $pdo->prepare('DELETE FROM umidade WHERE id=:id')->execute($row);
	}

	/**
	 * lastInfo
	 * ?controller=luminosidade&action=lastInfo
	 */
	public static function lastInfo() {
		$pdo = Db::getInstance();
		$sql = "SELECT * FROM umidade ORDER BY id DESC LIMIT 1";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$resultado = $stmt->fetch();

		if(!$resultado) return false;

		return [
			'id' => $resultado['id'],
			'umidade' => $resultado['umidade'],
			'tempo' => $resultado['tempo']
		];
	}
}