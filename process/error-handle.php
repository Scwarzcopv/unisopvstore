<?php
session_start();
# sembunyikan semua pesan error bawaan PHP
error_reporting(0);

/**
 * Fungsi untuk menangai error.
 * 
 * Fungsi ini wajib memiliki 4 paramter dan nama parameter bisa bebas.
 */
function tanganiError ($level, $message, $file, $line) {
    $_SESSION['error'] = true;
	header("Location: ../process/error-act.php#"); 
}

register_shutdown_function(function () {
    if (error_get_last()) {
        # ambil error terakhir
        $error = (object) error_get_last();
        
        # hapus semua output sebelum terjadi error
        ob_end_clean();

        tanganiError(
            $error->type, $error->message, $error->file, $error->line
        );
    }
});