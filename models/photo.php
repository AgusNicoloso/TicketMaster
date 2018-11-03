<?php
namespace models;

use Exception as Exception;

// if (!empty($_FILES['foto']['name'])) {
// 	$foto = $_FILES['foto'];

// } else {
// 	$foto = null;
// }

// $rutaFoto = new Foto();
// $rutaFoto->subirFoto($foto, "Perfiles");

class Photo
{

	private $direction;
	private $id;
	public function uploadPhoto($photo, $folder)
	{
		//$carpetas = array("Perfiles", "Productos");

		if (!empty($photo)) {


				$imageDirectory = ROOT . $folder . '/';


				if (!file_exists($imageDirectory)) {
					mkdir($imageDirectory);

				}

				if ($photo['name'] != '') {

					$allowedExtensions = array('png', 'jpg');
					$maxSize = 5000000;
					$fileName = basename($photo['name']);

					$file = $imageDirectory . $fileName;

					$fileExtension = pathinfo($file, PATHINFO_EXTENSION);

					if (in_array($fileExtension, $allowedExtensions)) {

						if ($photo['size'] < $maxSize) {

							if (move_uploaded_file($photo["tmp_name"], $file)) {

								$ruta = $folder . '/' . $fileName;
								$this->direction = $ruta;

							} else
								throw new Exception("Error al mover la Foto.");

						} else
							throw new Exception("Error, Se excedio el tamaño permitido.");

					} else
						throw new Exception("Error, formato de foto no permitida.");

				} else
					throw new Exception("Error, pongale un nombre a la foto.");

		} else
			$this->direction = null;

	}


	public function getDirection()
	{
		return $this->direction;
	}

	public function setDirection($newVal)
	{
		return $this->direction = $newVal;
	}
	public function getId() {return $this->id;}
}

?>
