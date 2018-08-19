<?php
class Luminosidade {
	private $id;
	private $luminosidade;
	private $tempo;

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function getLuminosidade() {
		return $this->luminosidade;
	}

	public function setLuminosidade($luminosidade) {
		$this->luminosidade = $luminosidade;
	}

	public function getTempo() {
		return $this->tempo;
	}

	public function setTempo($tempo) {
		$this->tempo = $tempo;
	}

	/**
	 * retrieveAll
	 * ?controller=luminosidade&action=retrieveAll
	 */
	public static function retrieveAll() {
		$pdo = Db::getInstance();
		$stmt = $pdo->query('SELECT * FROM luminosidade');
		$dados = [];

		while ($row = $stmt->fetch()) {
			$dados[] = [
				'id' => $row['id'],
				'luminosidade' => $row['luminosidade'],
				'tempo' => $row['tempo']
			];
		}

		return $dados;
	}

	/**
	 * retrieve
	 * ?controller=luminosidade&action=retrieve&id=1
	 */
	public static function retrieve($id) {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM luminosidade WHERE id = :id LIMIT 1';
		$row = ['id' => $id];

		$stmt = $pdo->prepare($sql);
		$stmt->execute($row);

		$resultado = $stmt->fetch();

		if(!$resultado) return false;

		return [
			'id' => $resultado['id'],
			'luminosidade' => $resultado['luminosidade'],
			'tempo' => $resultado['tempo']
		];
	}

	/**
	 * create
	 * ?controller=luminosidade&action=create&luminosidade=5
	 */
	public function create() {
		$this->luminosidade = floatval($this->luminosidade);
		if($this->luminosidade == 0) return false;

		$pdo = Db::getInstance();
		$sql = 'INSERT INTO luminosidade SET luminosidade=:luminosidade, tempo=:tempo;';
		$row = [
			'luminosidade' => $this->luminosidade,
			'tempo' => $this->tempo
		];

		$status = $pdo->prepare($sql)->execute($row);

		if ($status) return $pdo->lastInsertId();

		return false;
	}

	/**
	 * update
	 * ?controller=luminosidade&action=update&id=1&luminosidade=4
	 */
	public function update() {
		if(!$this->retrieve($this->getId())) return false;
		$this->setLuminosidade(floatval($this->getLuminosidade()));
		if(!$this->getLuminosidade()) return false;

		$pdo = Db::getInstance();
		$sql = 'UPDATE luminosidade SET luminosidade=:luminosidade, tempo=:tempo WHERE id=:id;';
		$row = [
			'id' => $this->getId(),
			'luminosidade' => $this->getLuminosidade(),
			'tempo' => $this->getTempo()
		];

		return $pdo->prepare($sql)->execute($row);
	}

	/**
	 * delete
	 * ?controller=luminosidade&action=delete&id=7
	 */
	public static function delete($id) {
		if(!Luminosidade::retrieve($id)) return false;
		$pdo = Db::getInstance();
		$row = ['id' => $id];
		return $pdo->prepare('DELETE FROM luminosidade WHERE id=:id')->execute($row);
	}

	/**
	 * lastInfo
	 * ?controller=luminosidade&action=lastInfo
	 * // ?controller=luminosidade&action=lastInfo&granjaid=1
	 */
	public static function lastInfo() {
		$pdo = Db::getInstance();
		$sql = "SELECT * FROM luminosidade ORDER BY id DESC LIMIT 1";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$resultado = $stmt->fetch();

		if(!$resultado) return false;

		return [
			'id' => $resultado['id'],
			'luminosidade' => $resultado['luminosidade'],
			'tempo' => $resultado['tempo']
		];
	}
}