<?php
class Umidade {
	private $id;
	private $umidade;
	private $tempo;

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

	public function __construct($umidade, $tempo) {
		parent::__construct();
		$this->umidade = $umidade;
		$this->tempo = $tempo;
	}

	/*
	 * create
	 */
	public function create() {
		$pdo = Db::getInstance();
		$sql = 'INSERT INTO umidade SET umidade=:umidade, tempo=:tempo;';
		$row = [
			'umidade' => $this->umidade,
			'tempo' => $this->tempo
		];

		$status = $pdo->prepare($sql)->execute($row);

		if ($status) {
			$umidade = $pdo->fetch();
			return new Umidade($umidade['id'], $umidade['umidade'], $umidade['tempo']);
		}

		return false;
	}

	/*
	 * retrieve
	 */
	public function retrieve($id) {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM umidade WHERE id = :id LIMIT 1';
		$row = ['id' => intval($id)];

		$status = $pdo->prepare($sql)->execute($row);
		if ($status) {
			$umidade = $pdo->fetch();
			return new Umidade($umidade['id'], $umidade['umidade'], $umidade['tempo']);
		}

		return false;
	}

	/*
	 * retrieveAll
	 */
	public function retrieveAll() {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM umidade';

		$status = $pdo->prepare($sql)->execute();

		if (!$status) {
			return [];
		}

		$objects = [];
		foreach ($pdo as $row) {
			$objects = array_push($objects, array(
				'id' => $row->getId(),
				'umidade' => $row->getUmidade(),
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
		$sql = 'UPDATE umidade SET umidade=:umidade, tempo=:tempo WHERE id=:id;';
		$row = [
			'id' => $this->getId(),
			'umidade' => $this->getUmidade(),
			'tempo' => $this->getTempo()
		];

		return $pdo->prepare($sql)->execute($row);
	}

	/*
	 * retrieveAll
	 */
	public function delete() {
		$pdo = Db::getInstance();
		$sql = 'DELETE FROM umidade WHERE id=:id';
		$row = ['id' => $this->id];

		return $pdo->prepare($sql)->execute($where);
	}
}