<?php
	class GranjaController {
		/**
     * getGranjaLastInfo
     * ?controller=granja&action=getGranjaLastInfo
     */
		public function getGranjaLastInfo() {
			echo json_encode(
				[
					"luminosidade" => Luminosidade::lastInfo(),
					"temperatura" => Temperatura::lastInfo(),
					"umidade" => Umidade::lastInfo()
				]
			);
		}
	}
?>