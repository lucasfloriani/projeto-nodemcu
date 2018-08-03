<?php
class Temperatura {
	private $id;
	private $temperatura;
	private $tempo;

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function getTemperatura() {
		return $this->temperatura;
	}

	public function setTemperatura($temperatura) {
		$this->temperatura = $temperatura;
	}

	public function getTempo() {
		return $this->tempo;
	}

	public function setTempo($tempo) {
		$this->tempo = $tempo;
	}

	/**
	 * retrieveAll
	 * ?controller=temperatura&action=retrieveAll
	 */
	public static function retrieveAll() {
		$pdo = Db::getInstance();
		$stmt = $pdo->query('SELECT * FROM temperatura');
		$dados = [];

		while ($row = $stmt->fetch()) {
			$dados[] = [
				'id' => $row['id'],
				'temperatura' => $row['temperatura'],
				'tempo' => $row['tempo']
			];
		}

		return $dados;
	}

	/**
	 * retrieve
	 * ?controller=temperatura&action=retrieve&id=1
	 */
	public static function retrieve($id) {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM temperatura WHERE id = :id LIMIT 1';
		$row = ['id' => $id];

		$stmt = $pdo->prepare($sql);
		$stmt->execute($row);

		$resultado = $stmt->fetch();

		if(!$resultado) return false;

		return [
			'id' => $resultado['id'],
			'temperatura' => $resultado['temperatura'],
			'tempo' => $resultado['tempo']
		];
	}

	/**
	 * create
	 * ?controller=temperatura&action=create&temperatura=5
	 */
	public function create() {
		$this->temperatura = floatval($this->temperatura);
		if($this->temperatura == 0) return false;

		$pdo = Db::getInstance();
		$sql = 'INSERT INTO temperatura SET temperatura=:temperatura, tempo=:tempo;';
		$row = [
			'temperatura' => $this->temperatura,
			'tempo' => $this->tempo
		];

		$status = $pdo->prepare($sql)->execute($row);

		if ($status) return $pdo->lastInsertId();

		return false;
	}

	/**
	 * update
	 * ?controller=temperatura&action=update&id=1&temperatura=4
	 */
	public function update() {
		if(!$this->retrieve($this->getId())) return false;
		$this->setTemperatura(floatval($this->getTemperatura()));
		if(!$this->getTemperatura()) return false;

		$pdo = Db::getInstance();
		$sql = 'UPDATE temperatura SET temperatura=:temperatura, tempo=:tempo WHERE id=:id;';
		$row = [
			'id' => $this->getId(),
			'temperatura' => $this->getTemperatura(),
			'tempo' => $this->getTempo()
		];

		return $pdo->prepare($sql)->execute($row);
	}

	/**
	 * delete
	 * ?controller=temperatura&action=delete&id=7
	 */
	public static function delete($id) {
		if(!Temperatura::retrieve($id)) return false;
		$pdo = Db::getInstance();
		$row = ['id' => $id];
		return $pdo->prepare('DELETE FROM temperatura WHERE id=:id')->execute($row);
	}
}