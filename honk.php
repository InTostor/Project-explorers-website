<?php
namespace Thedudeguy;
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

if (isset($_POST['submit'])) {}
$rcon = new Rcon('localhost', 25575, "C6322F6B9FC639DE69", 1);

if ($rcon->connect()){
 $rcon->sendCommand("broadcast Honk!");
}
?>

<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/honk.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <title> Project Explorers.Майнкрафт</title>
</head>

<form   method="post"   action="">

            <input  class="bttn" type="submit"   name="m_process"   value="honk?" />
        </form>
<?php
