<?php

namespace PhpOrient\Protocols\Binary\Operations;

use PhpOrient\Exceptions\PhpOrientException;
use PhpOrient\Protocols\Binary\Abstracts\Operation;
use PhpOrient\Protocols\Common\Constants;
use PhpOrient\Protocols\Binary\Abstracts\NeedDBOpenedTrait;

class DbReload extends Operation {
    use NeedDBOpenedTrait;

    /**
     * @var int The op code.
     */
    public $opCode = Constants::DB_RELOAD_OP;

    /**
     * Write the data to the socket.
     */
    protected function _write() {}

    /**
     * Read the response from the socket.
     *
     * @return true.
     */
    protected function _read() {

        $totalClusters = $this->_readShort();

        $dataClusters      = [ ];
        for ( $i = 0; $i < $totalClusters; $i++ ) {

            if( $this->_transport->getProtocolVersion() < 24 ){

                $dataClusters[ ] = [
                        'name'        => $this->_readString(),
                        'id'          => $this->_readShort(),
                        'type'        => $this->_readString(),
                        'dataSegment' => $this->_readShort()
                ];

            } else {
                $dataClusters[ ] = [
                        'name'        => $this->_readString(),
                        'id'          => $this->_readShort(),
                ];
            }

        }

        return $dataClusters;
    }

}