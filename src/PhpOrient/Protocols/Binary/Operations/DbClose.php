<?php

namespace PhpOrient\Protocols\Binary\Operations;

use PhpOrient\Protocols\Binary\Abstracts\Operation;
use PhpOrient\Protocols\Common\Constants;
use PhpOrient\Protocols\Binary\Abstracts\NeedDBOpenedTrait;

class DbClose extends Operation {
    use NeedDBOpenedTrait;

    /**
     * @var int The op code.
     */
    public $opCode = Constants::DB_CLOSE_OP;

    /**
     * Write the data to the socket.
     */
    protected function _write() {}
    protected function _read() {}

    /**
     * Read the response from the socket.
     *
     * @return int The session id.
     */
    public function getResponse() {
        $this->_socket->__destruct();
        $this->_transport->debug("Closed Connection");
        return 0;
    }

}
