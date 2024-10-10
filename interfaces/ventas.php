<?php /*
SELECT v.ID_venta, d.ID_producto, d.cantidad, v.ID_usuario, v.fecha FROM detalles_venta d JOIN ventas v ON v.ID_venta = d.ID_venta ORDER BY v.fecha;
*/ ?>