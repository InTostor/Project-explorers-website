<?php
//-----------------------------------------------------------------------------
// Пример выдачи поощрений за голосование на MinecraftRating.ru.
// Вся информация, высылаемая мониторингом находится в массиве $_POST
// и содержит следующие поля:
//
//		$_POST['username']		Имя пользователя, проголосовавшего за проект
//
//		$_POST['ip']			IP адрес проголосовавшего
//
//		$_POST['timestamp']		Время голосования в UNIX-формате
//
//		$_POST['signature']		SHA для проверки, пришел ли запрос от сайта
//								MinecraftRating.ru. Метод формирования
//								и использования указан ниже в коде.
// 
// 
//
// Шаблон для вашего скрипта выдачи поощрений.
// Для корректного отображения ошибок на сайте мониторинга
// Рекомендуется оставить файл в кодировке UTF8 (без BOM).
//
//-----------------------------------------------------------------------------

//-----------------------------------------------------------------------------
// Конфигурация
//-----------------------------------------------------------------------------

define ('SECRET_KEY',	'137354');		// Используйте ключ со страницы http://minecraftrating.ru/promotion.html,
										// предварительно авторизовавшись на сайте
/*INOP
//-----------------------------------------------------------------------------
define ('DB_HOSTNAME', 	'localhost');	// Хост базы данных MySQL
define ('DB_USERNAME', 	'root');		// Пользователь базы данных MySQL 
define ('DB_PASSWORD', 	'123123');		// Пароль пользователя MySQL
define ('DB_DATABASE', 	'samplecraft');	// Название базы данных MySQL
//-----------------------------------------------------------------------------
*/

//-----------------------------------------------------------------------------
// Вспомогательные функции
//-----------------------------------------------------------------------------
function post($key) {return isset($_POST[$key]) ? $_POST[$key]: NULL;}
//-----------------------------------------------------------------------------
function error($string)
{
	// Если вы будете посылать статус ошибки перед завершением скрипта,
	// умный мониторинг поймет, что у вас проблемы и известит вас об этом
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Server Error', TRUE, 500);

	// Завершает скрипт
	die(htmlspecialchars("site_error\n" . $string));
}
//-----------------------------------------------------------------------------



//-----------------------------------------------------------------------------
// Получаем данные из $_POST в соответствующие переменные и убеждаемся,
// что все данные пришли не пустыми.
//-----------------------------------------------------------------------------

$username	= $_POST['username'];
$ip		  	= $_POST['ip'];
$timestamp	= $_POST['timestamp'];
$signature	= $_POST['signature'];

// Убедимся, что прислали все нужные значения
if ( ! $username || ! $ip || ! $timestamp || ! $signature)
{
	error('Присланы не все данные, вероятно запрос подделан');
}


//-----------------------------------------------------------------------------
// Проверка подписи. С помощью этого небольшого кода вы можете убедиться, что
// запрос пришел именно с мониторинга MinecraftRating.ru. Этот кусок кода 
// не является обязательным и может быть удален не нарушая работы скрипта.
//-----------------------------------------------------------------------------

// Именно в такой последовательности мы собираем для вас подпись.
// Вы, зная свой SECRET KEY (его можно указать в личном кабинете),
// можете также собрать хеш из полученных данных и сравнить результат.
// Злоумышленник не сможет собрать такую подпись, не зная SECRET KEY.
$check_signature = sha1($username.$timestamp.SECRET_KEY);
// Пришла неправильная сигнатура
if ($check_signature != $signature)
{
	error('Неверная подпись / секретный ключ');
}

// Теперь мы убеждены, что запрос отправил MinecraftRating,
// и можем делать дорогостоящие операции.
//-----------------------------------------------------------------------------


// Подключаемся к базе MySQL INOP
/*
if ( ! $connection = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD))
{
	error('Не могу подключиться к базе данных');
}

// Выбираем базу данных
if ( ! mysql_select_db(DB_DATABASE))
{
	error('Не могу выбрать базу данных');
}


// На всякий случай экранируем спец.символы в имени игрока
$username = mysql_real_escape_string($username);


// Составляем запрос в базу данных.
// Вы можете изменить только этот запрос чтобы 
// подстроить скрипт под ваш проект.



// Пример запроса для плагина REDEEM (дадим предмет с ID 1)
$query = "INSERT INTO `redeem` (`player`, `item`) VALUES('$username', 1)";

// Пример запроса для плагина iconomy (даем 100 монет)
$query = "UPDATE `iconomy` SET `balance`=`balance`+100 WHERE `username`='$username'";
*/

//RCON подключение
$rcon = new Rcon('localhost', 25575, "C6322F6B9FC639DE69", 1);

        if ($rcon->connect()){
         $rcon->sendCommand("eco give {$username} 10000");
        }


/*
// Выполняем запрос
if ( ! mysql_query($query))
{
	error('Ошибка базы данных:' . mysql_error());
}

// Закрываем соединение с базой
mysql_close($connection);
*/

// Этот ответ мониторинг будет воспринимать как
// полностью успешное завершение передачи данных.
// Рекомендуется оставить эту строку.
echo 'ok';


class Rcon{
	private $host;
	private $port;
	private $password;
	private $timeout;
	private $socket;
	private $authorized = false;
	private $lastResponse = '';
	const PACKET_AUTHORIZE = 5;
	const PACKET_COMMAND = 6;
	const SERVERDATA_AUTH = 3;
	const SERVERDATA_AUTH_RESPONSE = 2;
	const SERVERDATA_EXECCOMMAND = 2;
	const SERVERDATA_RESPONSE_VALUE = 0;
	/**
	 * Create a new instance of the Rcon class.
	 * @param string $host
	 * @param integer $port
	 * @param string $password
	 * @param integer $timeout
	 */
	public function __construct($host, $port, $password, $timeout)
	{
		$this->host = $host;
		$this->port = $port;
		$this->password = $password;
		$this->timeout = $timeout;
	}

	/**
	 * Get the latest response from the server.
	 * @return string
	 */
	public function getResponse()
	{
		return $this->lastResponse;
	}
	/**
	 * Connect to a server.
	 * @return boolean
	 */
	public function connect(){
		$this->socket = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);

		if (!$this->socket) {
			$this->lastResponse = $errstr;
			return false;
		}

		//set timeout
		stream_set_timeout($this->socket, 3, 0);

		// check authorization
		return $this->authorize();
	}

	/**
	 * Disconnect from server.
	 *
	 * @return void
	 */
	public function disconnect()
	{
		if ($this->socket) {
					fclose($this->socket);
		}
	}

	/**
	 * True if socket is connected and authorized.
	 *
	 * @return boolean
	 */
	public function isConnected()
	{
		return $this->authorized;
	}

	/**
	 * Send a command to the connected server.
	 *
	 * @param string $command
	 *
	 * @return boolean|mixed
	 */
	public function sendCommand($command)
	{
		if (!$this->isConnected()) {
					return false;
		}

		// send command packet
		$this->writePacket(self::PACKET_COMMAND, self::SERVERDATA_EXECCOMMAND, $command);

		// get response
		$response_packet = $this->readPacket();
		if ($response_packet['id'] == self::PACKET_COMMAND) {
			if ($response_packet['type'] == self::SERVERDATA_RESPONSE_VALUE) {
				$this->lastResponse = $response_packet['body'];

				return $response_packet['body'];
			}
		}

		return false;
	}

	/**
	 * Log into the server with the given credentials.
	 *
	 * @return boolean
	 */
	private function authorize()
	{
		$this->writePacket(self::PACKET_AUTHORIZE, self::SERVERDATA_AUTH, $this->password);
		$response_packet = $this->readPacket();

		if ($response_packet['type'] == self::SERVERDATA_AUTH_RESPONSE) {
			if ($response_packet['id'] == self::PACKET_AUTHORIZE) {
				$this->authorized = true;

				return true;
			}
		}

		$this->disconnect();
		return false;
	}

	/**
	 * Writes a packet to the socket stream.
	 *
	 * @param $packetId
	 * @param $packetType
	 * @param string $packetBody
	 *
	 * @return void
	 */
	private function writePacket($packetId, $packetType, $packetBody)
	{
		/*
		Size			32-bit little-endian Signed Integer	 	Varies, see below.
		ID				32-bit little-endian Signed Integer		Varies, see below.
		Type	        32-bit little-endian Signed Integer		Varies, see below.
		Body		    Null-terminated ASCII String			Varies, see below.
		Empty String    Null-terminated ASCII String			0x00
		*/

		//create packet
		$packet = pack('VV', $packetId, $packetType);
		$packet = $packet.$packetBody."\x00";
		$packet = $packet."\x00";

		// get packet size.
		$packet_size = strlen($packet);

		// attach size to packet.
		$packet = pack('V', $packet_size).$packet;

		// write packet.
		fwrite($this->socket, $packet, strlen($packet));
	}

	/**
	 * Read a packet from the socket stream.
	 *
	 * @return array
	 */
	private function readPacket()
	{
		//get packet size.
		$size_data = fread($this->socket, 4);
		$size_pack = unpack('V1size', $size_data);
		$size = $size_pack['size'];

		// if size is > 4096, the response will be in multiple packets.
		// this needs to be address. get more info about multi-packet responses
		// from the RCON protocol specification at
		// https://developer.valvesoftware.com/wiki/Source_RCON_Protocol
		// currently, this script does not support multi-packet responses.

		$packet_data = fread($this->socket, $size);
		$packet_pack = unpack('V1id/V1type/a*body', $packet_data);

		return $packet_pack;
	}
}