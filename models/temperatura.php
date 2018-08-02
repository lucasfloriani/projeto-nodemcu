<?php
class Temperatura {
	private $id;
	private $temperatura;
	private $tempo;

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

	public function __construct($temperatura, $tempo) {
		parent::__construct();
		$this->temperatura = $temperatura;
		$this->tempo = $tempo;
	}

	/*
	 * create
	 */
	public function create() {
		$pdo = Db::getInstance();
		$sql = 'INSERT INTO temperatura SET temperatura=:temperatura, tempo=:tempo;';
		$row = [
			'temperatura' => $this->temperatura,
			'tempo' => $this->tempo
		];

		$status = $pdo->prepare($sql)->execute($row);

		if ($status) {
			$temperatura = $pdo->fetch();
			return new Temperatura($temperatura['id'], $temperatura['temperatura'], $temperatura['tempo']);
		}

		return false;
	}

	/*
	 * retrieve
	 */
	public function retrieve($id) {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM temperatura WHERE id = :id LIMIT 1';
		$row = ['id' => intval($id)];

		$status = $pdo->prepare($sql)->execute($row);
		if ($status) {
			$temperatura = $pdo->fetch();
			return new Temperatura($temperatura['id'], $temperatura['temperatura'], $temperatura['tempo']);
		}

		return false;
	}

	/*
	 * retrieveAll
	 */
	public function retrieveAll() {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM temperatura';

		$status = $pdo->prepare($sql)->execute();

		if (!$status) {
			return [];
		}

		$objects = [];
		foreach ($pdo as $row) {
			$objects = array_push($objects, array(
				'id' => $row->getId(),
				'temperatura' => $row->getTemperatura(),
				'tempo' => $row->getTempo()
			));
		}

		return $objects;
	}

	/*
	 * retrieveAll
	 */
	public function update() {
		$pdo = Db::getInstance();
		$sql = 'UPDATE temperatura SET temperatura=:temperatura, tempo=:tempo WHERE id=:id;';
		$row = [
			'id' => $this->getId(),
			'temperatura' => $this->getTemperatura(),
			'tempo' => $this->getTempo()
		];

		return $pdo->prepare($sql)->execute($row);
	}

	/*
	 * retrieveAll
	 */
	public function delete() {
		$pdo = Db::getInstance();
		$sql = 'DELETE FROM temperatura WHERE id=:id';
		$row = ['id' => $this->id];

		return $pdo->prepare($sql)->execute($where);
	}
}