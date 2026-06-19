<?php
$files = [
    'resources/views/reservasi.blade.php',
    'resources/views/admin/reservasi.blade.php',
    'resources/views/admin/order_admin.blade.php',
    'resources/views/history.blade.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // For orders: $order->menu to $order->items
        $content = str_replace('->menu', '->items', $content);
        
        // For nama -> name
        $content = str_replace('nama', 'name', $content);
        // Tapi "nama" bisa nabrak kata lain. Kita kembalikan "name_menu" -> "name" kalau ada (tadi nama_menu jadi name)
        
        file_put_contents($file, $content);
        echo "Updated $file\n";
    }
}
