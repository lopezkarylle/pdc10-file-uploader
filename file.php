<?php

class File
{
	protected $id;
	protected $label;
	protected $filename;
	protected $path;
	protected $type;

	const TYPE_DOCUMENT = 'document';
	const TYPE_IMAGE = 'image';

	const DIRECTORY_DOCUMENTS = 'documents/';
	const DIRECTORY_IMAGES = 'images/';

	public function __construct(
		$label,
		$path = null,
		$type = null
	)
	{
		$this->label = $label;
		$this->path = $path;
		$this->type = $type;
	}

	public function getLabel()
	{
		return $this->label;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getType()
	{
		return $this->type;
	}

	public function save()
	{
		global $pdo;
		try {

			$sql = "INSERT INTO files SET label=:label, path=:path, type=:type";
			$statement = $pdo->prepare($sql);

			return $statement->execute([
				':label' => $this->getLabel(),
				':path' => $this->getPath(),
				':type' => $this->getType()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public static function handleUpload($fileObject)
	{
		try {
			$base_dir = getcwd() . '/';
			$target_dir = $base_dir . static::DIRECTORY_DOCUMENTS;

			$check = getimagesize($fileObject['tmp_name']);
			if ($check !== false) {
				$target_dir = $base_dir . static::DIRECTORY_IMAGES;
			}

			if (is_uploaded_file($fileObject['tmp_name'])) {
				$target_file_path = $target_dir . $fileObject['name'];
				if (move_uploaded_file($fileObject['tmp_name'], $target_file_path)) {
					$file_type = static::TYPE_DOCUMENT;
					if (strpos($target_file_path, static::DIRECTORY_IMAGES)) {
						$file_type = static::TYPE_IMAGE;
					}
					return [
						'path' => $target_file_path,
						'type' => $file_type
					];
				}
			}
		} catch (Exception $e) {
			error_log($e->getMessage());
			return false;
		}
	}
}