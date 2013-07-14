<?php
/**
 * Server interface
 * 
 * @author alex
 */

namespace Rdy4Racing\Services\Server;

interface IServer {

    /**
     * Initialize the server
     */
    public function initServer();
    
    /**
     * Handles the server request
     */
    public function handle();
    
}
