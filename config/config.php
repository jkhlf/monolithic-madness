<?php
session_start();

// Ambiente (development ou production)
define('ENVIRONMENT', 'production');

// Configurações baseadas no ambiente
if (ENVIRONMENT === 'production') {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Configurações gerais
date_default_timezone_set('America/Sao_Paulo');
define('BASE_URL', 'http://seudominio.com');
define('ASSETS_URL', BASE_URL . '/assets');

// Configurações de segurança
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.gc_maxlifetime', 3600); // 1 hora
ini_set('session.cookie_lifetime', 3600); // 1 hora

// Incluir banco de dados
require_once 'database.php';