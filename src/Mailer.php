<?php

namespace ASCMedia\SimpleSiteBuilder;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
	private int $port;
	private string $host;
	private string $userName;
	private string $password;
	private string $fromBox;
	private string $fromName;
	private string $to;

	public function __construct(array $params) {
		$this->port = $params['port'];
		$this->host = $params['host'];
		$this->userName = $params['userName'];
		$this->password = $params['password'];
		$this->fromBox = $params['fromBox'];
		$this->fromName = $params['fromName'];
		$this->to = $params['to'];
	}

	public function sendEmail(string $subject, string $content): bool
	{
		try {
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = 'smtp';
			$mail->SMTPAuth = TRUE;
			$mail->SMTPSecure = 'ssl';
			$mail->Port = $this->port;
			$mail->Host = $this->host;
			$mail->Username = $this->userName;
			$mail->Password = $this->password;
			$mail->CharSet = 'UTF-8';
			$mail->IsHTML(true);
			$mail->AddAddress($this->to);
			$mail->SetFrom($this->fromBox, $this->fromName);
			$mail->Subject = $subject;
			$mail->MsgHTML($content);
			$mail->Send();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
