<?php

return [
    'index' => [
        'title' => 'Administración de tiendas',
        'subtitle' => 'Sucursales'
    ],
    'status' => [
        'inactive' => 'Inactiva',
        'active' => 'Activa'
    ],
    'datatable' => [
        'order' => 'N°',
        'title' => 'Título',
        'store' => 'Tienda',
        'phone' => 'Teléfono',
        'open-hours' => 'Horarios',
        'street' => 'Dirección',
        'email' => 'Mail',
        'detail' => 'Detalle',
        'status' => 'Estado',
        'create' => 'Agregar sucursal',
        'to_order' => 'Reordenar',
        'marketplace' => 'Tienda',
        'city' => 'Localidad',
        'website' => 'Website',
        'state' => 'Provincia',
        'latitude' => 'Latitud',
        'length' => 'Longuitud',
        'postal-code' => 'Código Postal',
        'country' => 'Pais',
        'description' => 'Descripción',
        'is_disabled' => 'Estado',
        'confirm' => 'Confirmar nuevo orden',
        'days' => [
            'mon' => 'lun',
            'tue' => 'mar',
            'wed' => 'mie',
            'thu' => 'jue',
            'fri' => 'vie',
            'sat' => 'sab',
            'sun' => 'dom',
        ]
    ],
    'create' => [
        'title' => 'El nombre es requerido',
        'first-appointment' => 'Primer Turno',
        'second-appointment' => 'Segundo Turno',
        'mon' => 'Lunes',
        'tue' => 'Martes',
        'wed' => 'Miércoles',
        'thu' => 'Jueves',
        'fri' => 'Viernes',
        'sat' => 'Sábado',
        'sun' => 'Domingo',
        'edit-title' => 'Editar sucursal',
        'form-title' => 'Datos en General',
        'form-schedules' => 'Horarios de Atención',
        'delete-button' => 'Eliminar sucursal',
        'delete-title' => 'Eliminar sucursal',
        'delete-question' => '¿Desea eliminar la sucursal :name?',
        'delete-cancel' => 'Cancelar',
        'delete-confirm' => 'Eliminar sucursal',
        'delete-success' => 'Sucursal Eliminada',
        'order-success' => 'Sucursales Ordenadas',
        'file-send-error' => 'Error al intentar enviar Archivo',
        'file-send-success' => 'Archvio Enviado con éxito',
        'api-key' => 'Secreto',
        'select' => 'Seleccionar',
        'create' => 'Crear sucursal',
        'update' => 'Guardar cambios',
        'status' => 'Estado',
        'error' => 'No se pudo crear la sucursal',
        'exists' => 'Ya existe una sucursal con la dirección y localidad ingresadas',
        'actions' => [
            "order_billing_pending" => 'Cambio a facturación pendiente',
            "order_pod_pending" => 'Cambio a impresión pendiente',
            "order_shipment_pending" => 'Cambio a envío pendiente',
            "order_item_modified" => 'Cambio en Item de orden',
        ],
        'fields' => [
            'name' => 'El nombre es requerido',
            'channel' => 'El canal es requerido',
            'country' => 'El pais es requerido',
            'area' => 'El area es requerido',
            'phone' => 'El telefono debe ser valido y unico',
            'timezone' => 'La zona horaria es requerida',

        ]
    ],
    'detail' => [
        'created' => 'Sucursal creada correctamente',
        'edited' => 'Cambios guardados correctamente'
    ]
];