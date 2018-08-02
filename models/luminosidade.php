<?php
class Luminosidade {
	private $id;
	private $luminosidade;
	private $tempo;

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

	public function __construct($luminosidade, $tempo) {
		parent::__construct();
		$this->luminosidade = $luminosidade;
		$this->tempo = $tempo;
	}

	/*
	 * create
	 */
	public function create() {
		$pdo = Db::getInstance();
		$sql = 'INSERT INTO luminosidade SET luminosidade=:luminosidade, tempo=:tempo;';
		$row = [
			'luminosidade' => $this->luminosidade,
			'tempo' => $this->tempo
		];

		$status = $pdo->prepare($sql)->execute($row);

		if ($status) {
			$luminosidade = $pdo->fetch();
			return new Luminosidade($luminosidade['id'], $luminosidade['luminosidade'], $luminosidade['tempo']);
		}

		return false;
	}

	/*
	 * retrieve
	 */
	public function retrieve($id) {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM luminosidade WHERE id = :id LIMIT 1';
		$row = ['id' => intval($id)];

		$status = $pdo->prepare($sql)->execute($row);
		if ($status) {
			$luminosidade = $pdo->fetch();
			return new Luminosidade($luminosidade['id'], $luminosidade['luminosidade'], $luminosidade['tempo']);
		}

		return false;
	}

	/*
	 * retrieveAll
	 */
	public function retrieveAll() {
		$pdo = Db::getInstance();
		$sql = 'SELECT * FROM luminosidade';

		$status = $pdo->prepare($sql)->execute();

		if (!$status) {
			return [];
		}

		$objects = [];
		foreach ($pdo as $row) {
			$objects = array_push($objects, array(
				'id' => $row->getId(),
				'luminosidade' => $row->getLuminosidade(),
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
		$sql = 'UPDATE luminosidade SET luminosidade=:luminosidade, tempo=:tempo WHERE id=:id;';
		$row = [
			'id' => $this->getId(),
			'luminosidade' => $this->getLuminosidade(),
			'tempo' => $this->getTempo()
		];

		return $pdo->prepare($sql)->execute($row);
	}

	/*
	 * retrieveAll
	 */
	public function delete() {
		$pdo = Db::getInstance();
		$sql = 'DELETE FROM luminosidade WHERE id=:id';
		$row = ['id' => $this->id];

		return $pdo->prepare($sql)->execute($where);
	}
}