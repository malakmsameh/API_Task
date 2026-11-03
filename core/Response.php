<?php

// never is like a void function prevents return and the function stays working and we have to use exit 
class Response
{
	public static function json
	(
		int $statuscode,
		array $data
	): never{
		http_response_code($statuscode);
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		exit;
	}
}


?>